<?php
$activeDirectory = array();
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
 
 // Function to get the client IP address
function get_client_ip_v3() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

 
if(!empty($_SERVER['SERVER_ADDR'])){
	$ip_router = $_SERVER['SERVER_ADDR'];
}else{
	/*
	$externalContent = file_get_contents('http://checkip.dyndns.com/');
	preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
	$ip_router = $m[1];
	*/
	$ip_router = gethostbyname($_SERVER['SERVER_NAME']);
	if($ip_router==""){
		$ip_router =getip();
	}
}