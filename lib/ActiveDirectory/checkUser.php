<?php
include("../session.php");
// include("../config.php");
// include("../connect.php");
include("../function.php");
require_once 'config_f.php';
require_once 'ActiveDirectory.php';
//$username=trim($_POST['Valueusername']);
$username = trim($_POST['inputUserName']);

if ($username != '') {

	$ad = new ActiveDirectory($activeDirectory['key'],$activeDirectory['secret'], $domainLink, getip(), $ip_router);
	$obj_url = $ad->getURLOneAccount();
	$obj = $ad->checkUsername($username);
	
	header('Content-Type: application/json');
	echo $obj;
} ?>



