<?php
$check_login_status = 1;
include("../../lib/session.php");
include("../../lib/config.php");
include("../../lib/connect.php");
include("../../lib/function.php");
include("lib/config.php");
include("lib/function.php");

use ActiveOAuth2\Controller;

$clientId = 'datacenter-sso';
$clientSecret = 'ZGF0YWNlbnRlci1zc298d3xNbVcwblR5MHJVSWpESjFDcTJJWnF6MWNNM0UwTDJ5T3JQOWpMejFjcTJrWlkyMWhNMnkwb0p5eHJUU2pNSjEzcWw5Wm5UMTBNbDUwbzJ5YXJQNWpwejF3cTIxWk1UMGhNM1cwTUp5MHJUNWpNSjF3cTJTWnFUMXVNMkUwWTJ4aXJRY2pwMjFqcTNFWnFUMWJNMDkwQzJ5ZnJVV2pxSjB6cTI5WnAyMW1NbDEwcHp5eXJVRWpvejF5cTJBWkxKMTBNMlMwTVR5Q3JROWpySjF5cTJnWnFUMXlNM1cwTDJ5eXJVWiUzUQ==';
$url = "https://sso.dmcr.go.th";
$url_redirect = "https://datacenter.dmcr.go.th/weadmin/lib/ActiveOAuth2";

$provider = array(
    'clientId'                => $clientId,
    'clientSecret'            => $clientSecret,
    'redirectUri'             => $url_redirect,
    'urlAuthorize'            => $url . '/oauth/login',
    'urlAccessToken'          => $url . '/oauth/token',
    'urlResourceOwnerDetails' => $url . '/api/sso/resource',
    'scopes'                  => 'openid profile email'
);
$controller = new Controller($provider);

if (isset($_GET['state'])) {
    $_SESSION['oauth2state'] = $_GET['state'];
}

if (!isset($_GET['code'])) {
    $url = $controller->getAuthorizationUrl();
    header('Location: ' . $url);
    exit;
} elseif (isset($_GET['code']) && isset($_SESSION['oauth2state']) && $_SESSION['oauth2state'] === $_GET['state']) {
    try {
        $accessToken = $controller->sendCURL($url . '/oauth/token', [
            'Authorization: Bearer ' . base64_encode($clientId . ':' . $clientSecret),
            'Content-Type: application/json'
        ], 'POST', [
            'grant_type' => 'authorization_code',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri' => $url_redirect,
            'code' => $_GET['code']
        ]);
        if (!$accessToken->access_token) {
            exit('Failed to get access token: ' . $accessToken->message);
        }
        $resourceOwner = $controller->sendCURL($url . '/api/sso/resource', [
            'Authorization: Bearer ' . $accessToken->access_token
        ], 'GET');
        if (!$resourceOwner) {
            exit('Failed to get resource owner: ' . $resourceOwner->message);
        }
        $userInfo = (array) $resourceOwner;
        
        $sql = "SELECT 
        " . $core_tb_staff . "_id as id,
        " . $core_tb_staff . "_fnamethai as fnamethai,
        " . $core_tb_staff . "_lnamethai as lnamethai,
        " . $core_tb_staff . "_groupid as groupid,
        " . $core_tb_staff . "_username as username,
        " . $core_tb_staff . "_usertype as usertype,
        " . $core_tb_staff . "_picture as picture
        FROM " . $core_tb_staff . " WHERE binary " . $core_tb_staff . "_username='" . $userInfo['username'] . "'  AND " . $core_tb_staff . "_status !='Disable' ";
        $sql .= " AND " . $core_tb_staff . "_usertype = '2'";
        $Query = wewebQueryDB($coreLanguageSQL, $sql);
        $RecordCount = wewebNumRowsDB($coreLanguageSQL, $Query);
        if ($RecordCount >= 1) {
            $Row = wewebFetchArrayDB($coreLanguageSQL, $Query);
            $usertype = $Row['usertype'];
            if ($usertype == 2) {
                $_SESSION[$valSiteManage . "core_session_id"]        = $Row[0];
                $_SESSION[$valSiteManage . "core_session_name"]       = rechangeQuot($userInfo['fnamethai']) . " " . rechangeQuot($userInfo['lnamethai']);
                $_SESSION[$valSiteManage . "core_session_nameen"]       = rechangeQuot($userInfo['fnamethai']) . " " . rechangeQuot($userInfo['lnamethai']);
                $_SESSION[$valSiteManage . "core_session_groupid"]    = $Row['groupid'];
                $_SESSION[$valSiteManage . "core_session_language"]  = getSystemLang();
                $_SESSION[$valSiteManage . "core_session_languageT"]    = getSystemLangType();
                $_SESSION[$valSiteManage . "core_session_picture"] = $userInfo['picture'];
                $_SESSION[$valSiteManage . "core_session_logout"] = 1;

                $sql_lv = "SELECT " . $core_tb_group . "_lv FROM " . $core_tb_group . " WHERE " . $core_tb_group . "_id='" . $Row['groupid'] . "'";
                $Query_lv = wewebQueryDB($coreLanguageSQL, $sql_lv);
                $Row_lv = wewebFetchArrayDB($coreLanguageSQL, $Query_lv);
                $_SESSION[$valSiteManage . "core_session_level"]        = $Row_lv[0];

                ###################### Start insert logs ##################
                logs_access('1', 'Login');

                if ($coreLanguageSQL == "mssql") {
                    $sqlLog = "DELETE FROM " . $core_tb_log . " WHERE " . $core_tb_log . "_time < DATEADD(mm, -3, GETDATE())";
                } else {
                    $sqlLog = "DELETE FROM " . $core_tb_log . " WHERE " . $core_tb_log . "_time < DATE_SUB(" . wewebNow($coreLanguageSQL) . ", INTERVAL  3 MONTH)";
                }
                $queryLog = wewebQueryDB($coreLanguageSQL, $sqlLog);

                // ## Start Security Upload Permission #############################################
                $_SESSION[$valSiteManage . "core_session_premission"]    = getUserPermissionOnMenuAll($_SESSION[$valSiteManage . "core_session_groupid"], $_SESSION[$valSiteManage . "core_session_id"]);
                // ## End Security Upload Permission #############################################

                // setup data to array
                $userInfo = array(
                    'prefix' => $lang['constant']['prefix'][$userInfo['prefix']],
                    'gender' => $lang['constant']['gender'][$userInfo['gender']],
                    'fnamethai' => $userInfo['fnamethai'],
                    'lnamethai' => $userInfo['lnamethai'],
                    'fnameeng' => $userInfo['fnameeng'],
                    'lnameeng' => $userInfo['lnameeng'],
                    'address' => $userInfo['address'],
                    'telephone' => $userInfo['telephone'],
                    'mobile' => $userInfo['mobile'],
                    'email' => $userInfo['email'],
                    'unitid' => $userInfo['unitid'],
                    'unitid_sub' => $userInfo['unitid_sub'],
                    'position' => $userInfo['position'],
                    'other' => $userInfo['other'],
                );

                // start 21/01/64
                $valLnameADuserPrefix = rechangeQuot($userInfo['prefix']);
                $valLnameADuserGender = rechangeQuot($userInfo['gender']);
                $valNameADuser = rechangeQuot($userInfo['fnamethai']);
                $valLnameADuser = rechangeQuot($userInfo['lnamethai']);
                $valNameADuserEng = rechangeQuot($userInfo['fnameeng']);
                $valLnameADuserEng = rechangeQuot($userInfo['lnameeng']);
                $valLnameADuserAddress = rechangeQuot($userInfo['address']);
                $valLnameADuserTelephone = rechangeQuot($userInfo['telephone']);
                $valLnameADuserMobile = rechangeQuot($userInfo['mobile']);
                $valLnameADuserEmail = rechangeQuot($userInfo['email']);
                $valLnameADuserUnitid = rechangeQuot($userInfo['unitid']);
                $valLnameADuserUnitidSub = rechangeQuot($userInfo['unitid_sub']);
                $valLnameADuserPosition = rechangeQuot($userInfo['position']);
                $valLnameADuserOther = rechangeQuot($userInfo['other']);
                // end 21/01/64

                // check data and update to database
                $update = array();
                if ($valLnameADuserPrefix != null && $valLnameADuserPrefix != '') {
                    $update[] = $core_tb_staff . "_prefix   ='" . $valLnameADuserPrefix . "'";
                }
                if ($valLnameADuserGender != null && $valLnameADuserGender != '') {
                    $update[] = $core_tb_staff . "_gender   ='" . $valLnameADuserGender . "'";
                }
                if ($valNameADuser != null && $valNameADuser != '') {
                    $update[] = $core_tb_staff . "_fnamethai    ='" . $valNameADuser . "'";
                }
                if ($valLnameADuser != null && $valLnameADuser != '') {
                    $update[] = $core_tb_staff . "_lnamethai    ='" . $valLnameADuser . "'";
                }
                if ($valNameADuserEng != null && $valNameADuserEng != '') {
                    $update[] = $core_tb_staff . "_fnameeng     ='" . $valNameADuserEng . "'";
                }
                if ($valLnameADuserEng != null && $valLnameADuserEng != '') {
                    $update[] = $core_tb_staff . "_lnameeng     ='" . $valLnameADuserEng . "'";
                }
                if ($valLnameADuserPosition != null && $valLnameADuserPosition != '') {
                    $update[] = $core_tb_staff . "_position     ='" . $valLnameADuserPosition . "'";
                }
                if ($valLnameADuserEmail != null && $valLnameADuserEmail != '') {
                    $update[] = $core_tb_staff . "_email    ='" . $valLnameADuserEmail . "'";
                }
                if ($valLnameADuserAddress != null && $valLnameADuserAddress != '') {
                    $update[] = $core_tb_staff . "_address      ='" . $valLnameADuserAddress . "'";
                }
                if ($valLnameADuserMobile != null && $valLnameADuserMobile != '') {
                    $update[] = $core_tb_staff . "_mobile   ='" . $valLnameADuserMobile . "'";
                }
                if ($valLnameADuserTelephone != null && $valLnameADuserTelephone != '') {
                    $update[] = $core_tb_staff . "_telephone    ='" . $valLnameADuserTelephone . "'";
                }
                if ($valLnameADuserOther != null && $valLnameADuserOther != '') {
                    $update[] = $core_tb_staff . "_other    ='" . $valLnameADuserOther . "'";
                }
                if ($valLnameADuserUnitid != null && $valLnameADuserUnitid != '') {
                    $update[] = $core_tb_staff . "_unitid   ='" . $valLnameADuserUnitid . "'";
                }
                if ($valLnameADuserUnitidSub != null && $valLnameADuserUnitidSub != '') {
                    $update[] = $core_tb_staff . "_unitid_sub   ='" . $valLnameADuserUnitidSub . "'";
                }
                $update[] = $core_tb_staff . "_logdate     =" . wewebNow($coreLanguageSQL) . "";

                $sql = "UPDATE " . $core_tb_staff . " SET " . implode(",", $update) . " WHERE " . $core_tb_staff . "_id='" . $_SESSION[$valSiteManage . "core_session_id"] . "' ";
                $Query = wewebQueryDB($coreLanguageSQL, $sql);
                $txtLinkUrlTo = "../../core/index.php";
                $txtErrorMsg = "";
            } else {
                $txtLinkUrlTo = "../../index.php";
                $txtErrorMsg = "กรุณาติดต่อ Domain User One Account";
            }
        } else {
            $txtLinkUrlTo = "../../index.php";
            $txtErrorMsg = "กรุณาติดต่อ Domain User One Account";
        }
    } catch (Exception $e) {
        $txtLinkUrlTo = "../../index.php";
        $txtErrorMsg = "กรุณาติดต่อ Domain User One Account";
    }
} else {
    $txtLinkUrlTo = "../../index.php";
    $txtErrorMsg = "กรุณาติดต่อ Domain User One Account";
}
?>

<!-- redirect to target url -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Working...</title>
</head>
<body>
    <form action="<?php echo $txtLinkUrlTo ?>" name="myFormAction" id="myFormAction" method="post">
        <input type="hidden" name="error_msg" id="error_msg" value="<?php echo $txtErrorMsg ?>">
    </form>
</body>
</html>
<script>
    document.myFormAction.submit();
</script>