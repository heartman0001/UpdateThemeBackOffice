<?php
include("../session.php");
// include("../config.php");
// include("../connect.php");
include("../function.php");
include('config_f.php');
require_once 'ActiveDirectory.php';
//$username=trim($_POST['Valueusername']);
$username = trim($inputUserName);
$status = trim($inputstatusname);
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
//print_pre($activeDirectory);
if ($username != '') {

	$ad = new ActiveDirectory($activeDirectory['key'],$activeDirectory['secret'], $domainLink, getip(), $ip_router);
	
	$obj_url = $ad->getURLOneAccount();
	$obj = $ad->updatePermission($username,$status);
	//print_pre($obj);
} ?>



