<?php
include("config_f.php");
require_once 'ActiveDirectory.php';
$activeDirectory['key'] = 'oneaccount-qrcode-website';
//$activeDirectory['secret'] = 'q2IZMT1iM2A0pzykrP1jpz1wq21ZMT0gMmA0Zzy2rTIjMT0iq21Zo21wMl50MTy1rT9joT1wq2WZMJ13M2I0q2xhrUEjp21yq3EZG20%2SM2k0pzy1rPMjMJ10q2yZp21vM2I0q2xgrTIjMT1iq2AZpz1kMl10qTyhrUIjo21wq2AZLJ1yM250o2yCrQ9jrJ1yq2gZqT1yM3W0L2yyrUZ%3Q';
$activeDirectory['secret'] = 'oJuaqUDhnJ94M3NhoKW3L0kgoJEaYaEynJE4o3OwoKW3pHkCoG9aoUElnKI4WaOyoKE3nHkmoJWaMKE3nF14MKOxoJ93L0kloKSaYKE0nJ54qKOioJA3L0kuoJIaoaEinH94C3O5oJI3n0k0oJIapaEwnJI4pj%3Q%3Q';
// $protocol=strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
// $domainLink=$protocol.'://'.$_SERVER['HTTP_HOST'];
// $domainLink=$_SERVER['HTTP_ORIGIN'];
$domainLink = explode('www.', $_SERVER['SERVER_NAME']);
$domainLink = end($domainLink);
$uri = explode('/', $_SERVER['REQUEST_URI']);
foreach ($uri as $key => $value) {
	if (!empty($value) && $value != 'weadmin') {
		$path_url = '/'.$uri[$key];
		break;
	}
	if ($value == 'weadmin') {
		$path_url = '';
		break;
	}
}
$domainLink.=$path_url;
$ad = new ActiveDirectory($activeDirectory['key'],$activeDirectory['secret'], $domainLink, getip(), $ip_router);
//print_pre('kkkkk');
$obj_url = $ad->getURLOneAccount();
$obj = json_decode($ad->getTokenForLogin($inputUserMaster));

if ($obj->status == true) {
    $obj_login = json_decode($ad->loginWebSite($inputUserMaster, $inputPass, $obj->access_token));
     //print_pre($obj_login);
     //die;

    if ($obj_login->status == true) {
	
        $_SESSION[$valSiteManage."core_session_logout"]=1;
        $sql = "SELECT
        ".$core_tb_staff."_id,
        ".$core_tb_staff."_password,
        ".$core_tb_staff."_fnamethai,
        ".$core_tb_staff."_lnamethai,
        ".$core_tb_staff."_groupid ,
        ".$core_tb_staff."_storeid,
        ".$core_tb_staff."_usertype as usertype,
		".$core_tb_staff."_username as username,
        ".$core_tb_staff."_permisfile as permisfile
        FROM ".$core_tb_staff."
            INNER JOIN ".$core_tb_group."
            ON ".$core_tb_staff.".".$core_tb_staff."_groupid = ".$core_tb_group.".".$core_tb_group."_id
        WHERE binary ".$core_tb_staff."_username='".$inputUser."'  AND ".$core_tb_staff."_status !='Disable'  AND ".$core_tb_staff."_approved ='Approved' ";
        $Query=wewebQueryDB($coreLanguageSQL,$sql);
        $RecordCount=wewebNumRowsDB($coreLanguageSQL,$Query);

        if($RecordCount>=1) {
         $Row=wewebFetchArrayDB($coreLanguageSQL,$Query);
        // start 21/01/64
        $valLnameADuserPrefix = rechangeQuot($obj_login->profile->prefix);
        $valLnameADuserGender = rechangeQuot($obj_login->profile->gender);
        $valNameADuser = rechangeQuot($obj_login->profile->fnamethai);
        $valLnameADuser = rechangeQuot($obj_login->profile->lnamethai);
        $valNameADuserEng = rechangeQuot($obj_login->profile->fnameeng);
        $valLnameADuserEng = rechangeQuot($obj_login->profile->lnameeng);
        $valLnameADuserAddress = rechangeQuot($obj_login->profile->address);
        $valLnameADuserTelephone = rechangeQuot($obj_login->profile->telephone);
        $valLnameADuserMobile = rechangeQuot($obj_login->profile->mobile);
        $valLnameADuserEmail = rechangeQuot($obj_login->profile->email);
        $valLnameADuserUnitid = rechangeQuot($obj_login->profile->unitid);
        $valLnameADuserUnitidSub = rechangeQuot($obj_login->profile->unitid_sub);
        $valLnameADuserPosition = rechangeQuot($obj_login->profile->position);
        $valLnameADuserOther = rechangeQuot($obj_login->profile->other);
        $valLnameADuserStoreid = rechangeQuot($obj_login->profile->storeid);
        // end 21/01/64


		
        $_SESSION[$valSiteManage."core_session_id"]		= $Row[0];
       // $_SESSION[$valSiteManage."core_session_name"]       = rechangeQuot($obj_login->profile->fnamethai)." ".rechangeQuot($obj_login->profile->lnamethai);
		$_SESSION[$valSiteManage."core_session_name"]       = $Row['username']; 
        $_SESSION[$valSiteManage."core_session_nameen"]       = rechangeQuot($obj_login->profile->fnameeng)." ".rechangeQuot($obj_login->profile->lnameeng);
        $_SESSION[$valSiteManage."core_session_groupid"]	= $Row[4];
        $_SESSION[$valSiteManage."core_session_unitid"]	= $valLnameADuserUnitid;
        $_SESSION[$valSiteManage."core_session_permisfile"] = $Row['permisfile'];

        $_SESSION[$valSiteManage."core_session_language"]  = getSystemLang();
        $_SESSION[$valSiteManage."core_session_languageT"]	= getSystemLangType();
        $_SESSION[$valSiteManage."core_session_storeid"] = $Row[5];
        $_SESSION[$valSiteManage."core_session_picture"] = $obj_login->profile->picture;
        $_SESSION[$valSiteManage."core_session_logout"]=1;

        $sql_lv = "SELECT ".$core_tb_group."_lv FROM ".$core_tb_group." WHERE ".$core_tb_group."_id='".$Row[4]."'";
        $Query_lv=wewebQueryDB($coreLanguageSQL,$sql_lv);
        $Row_lv=wewebFetchArrayDB($coreLanguageSQL,$Query_lv);
        $_SESSION[$valSiteManage."core_session_level"]		= $Row_lv[0];


        ###################### Start insert logs ##################
        logs_access('1','Login');

        if($coreLanguageSQL=="mssql"){
        $sqlLog = "DELETE FROM ".$core_tb_log." WHERE ".$core_tb_log."_time < DATEADD(mm, -3, GETDATE())";
        }else{
        $sqlLog = "DELETE FROM ".$core_tb_log." WHERE ".$core_tb_log."_time < DATE_SUB(".wewebNow($coreLanguageSQL).", INTERVAL  3 MONTH)";
        }
        $queryLog=wewebQueryDB($coreLanguageSQL,$sqlLog);


        // start 21/01/64
        $update = array();
        $update[]=$core_tb_staff."_storeid      ='".$valLnameADuserStoreid."'";
        $update[]=$core_tb_staff."_prefix   ='".$valLnameADuserPrefix."'";
        $update[]=$core_tb_staff."_gender   ='".$valLnameADuserGender."'";
        $update[]=$core_tb_staff."_fnamethai    ='".$valNameADuser."'";
        $update[]=$core_tb_staff."_lnamethai    ='".$valLnameADuser."'";
        $update[]=$core_tb_staff."_fnameeng     ='".$valNameADuserEng."'";
        $update[]=$core_tb_staff."_lnameeng     ='".$valLnameADuserEng."'";
        
        $update[]=$core_tb_staff."_position     ='".$valLnameADuserPosition."'";

        $update[]=$core_tb_staff."_email    ='".$valLnameADuserEmail."'";
        $update[]=$core_tb_staff."_address      ='".$valLnameADuserAddress."'";
        $update[]=$core_tb_staff."_mobile   ='".$valLnameADuserMobile."'";
        $update[]=$core_tb_staff."_telephone    ='".$valLnameADuserTelephone."'";
        $update[]=$core_tb_staff."_other    ='".$valLnameADuserOther."'";
        
        $update[]=$core_tb_staff."_unitid   ='".$valLnameADuserUnitid."'";
        $update[]=$core_tb_staff."_unitid_sub   ='".$valLnameADuserUnitidSub."'";
        $update[]=$core_tb_staff."_logdate     =".wewebNow($coreLanguageSQL)."";

        $sql="UPDATE ".$core_tb_staff." SET ".implode(",",$update)." WHERE ".$core_tb_staff."_id='".$_SESSION[$valSiteManage."core_session_id"]."' ";
        $Query=wewebQueryDB($coreLanguageSQL,$sql); 
        // end 21/01/64



        if($inputUrl!=""){
            $txtLinkUrlTo= "../".$inputUrl;
        }else{
            $txtLinkUrlTo="core/index.php";
        }
        ?>
		<script language="JavaScript"  type="text/javascript">
			document.location.href = "<?=$txtLinkUrlTo?>";
		</script>
    <?php }else{?>
        <script language="JavaScript"  type="text/javascript">
            jQuery("#loadAlertLogin").hide();
            jQuery("#loadAlertLoginOA").show();
            jQuery("#loadAlertLoginOA").html('<img src="img/btn/error.png" align="absmiddle" hspace="10" /> ไม่พบข้อมูลผู้ใช้นี้ในระบบ หรือ ผู้ใช้งานยังไม่ได้รับการอนุมัติ');
			document.myFormLogin.inputUser.value='';
			document.myFormLogin.inputPass.value='';
		</script>
    <?php } ?>
	<?

    }else{
        ?>
		<script language="JavaScript"  type="text/javascript">
            jQuery("#loadAlertLogin").hide();
            jQuery("#loadAlertLoginOA").show();
            jQuery("#loadAlertLoginOA").html('<img src="img/btn/error.png" align="absmiddle" hspace="10" /> กรุณาติดต่อ Domain User One Account');
			document.myFormLogin.inputUser.value='';
			document.myFormLogin.inputPass.value='';
		</script>
		<?
    }
}
