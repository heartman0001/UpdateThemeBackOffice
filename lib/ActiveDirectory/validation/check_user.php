<?php
$check_login_status = 1;
include("../../session.php");
include("../../config.php");
include("../../connect.php");
include("../../function.php");
include("../../../core/incLang.php");

$inputUser = trim($_POST["inputUser"]);
$inputPass = trim($_POST["inputPass"]);

$inputUserMaster = changeQuot($inputUser);
$inputPassMaster = encodeStr($inputPass);

$sqlMaster = "SELECT " . $core_tb_staff . "_id FROM " . $core_tb_staff . " WHERE " . $core_tb_staff . "_username='" . encodeStr($inputUserMaster) . "' AND " . $core_tb_staff . "_password='" . $inputPassMaster . "'  AND " . $core_tb_staff . "_status='Superadmin'    ";
$queryMaster = wewebQueryDB($coreLanguageSQL, $sqlMaster);
$recordMaster = wewebNumRowsDB($coreLanguageSQL, $queryMaster);


$arrJson = array();
if ($recordMaster >= 1) {
    $arrJson['status'] = true;
    $arrJson['type'] = 3;
    $arrJson['role'] = 'Superadmin';
} else {
    $sql = "SELECT
    " . $core_tb_staff . "_id,
    " . $core_tb_staff . "_password,
    " . $core_tb_staff . "_fnamethai,
    " . $core_tb_staff . "_lnamethai,
    " . $core_tb_staff . "_groupid, 
    " . $core_tb_staff . "_usertype as usertype  
    FROM " . $core_tb_staff . "
	INNER JOIN " . $core_tb_group . "
	ON " . $core_tb_staff . "." . $core_tb_staff . "_groupid = " . $core_tb_group . "." . $core_tb_group . "_id
    WHERE binary " . $core_tb_staff . "_username='" . $inputUser . "'  AND " . $core_tb_staff . "_status !='Disable'   AND " . $core_tb_group . "_status !='Disable' ";
    $Query = wewebQueryDB($coreLanguageSQL, $sql);
    $RecordCount = wewebNumRowsDB($coreLanguageSQL, $Query);
	if ($RecordCount >= 1) {
		$Row = wewebFetchArrayDB($coreLanguageSQL, $Query);
		$usertype = $Row['usertype'];
		if ($usertype == 1 || $usertype == 0) {
			### Private User
            $arrJson['status'] = true;
            $arrJson['type'] = 1;
            $arrJson['role'] = 'Private User';
        }else{
			### Domain User
            $arrJson['status'] = true;
            $arrJson['type'] = 2;
            $arrJson['role'] = 'Domain User';
        }
    }else{
        $arrJson['status'] = false;
        $arrJson['type'] = 0;
        $arrJson['role'] = 'Not found user';
    }
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($arrJson);
exit(0);