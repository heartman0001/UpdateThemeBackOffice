<?php

class ActiveDirectory
{

    public $URL_GET_ONE_ACCOUNT = 'https://www.dmcr.go.th/api/putApiOneAccount.php';
    // public $URL_OAUTH_ACCESS_TOKEN = 'http://oneaccount.dmcr.go.th/auth/v1/accessToken';
    // public $URL_GET_PROFILE = 'http://oneaccount.dmcr.go.th/auth/v1/getProfile';
    public $URL_OAUTH_ACCESS_TOKEN = '/auth/v1/accessToken';
    public $URL_GET_PROFILE = '/auth/v1/getProfile';
    public $URL_CHECK_USER = '/auth/v1/checkUser';
    public $URL_CALL_NAME = '/api/v1/callNamePage';
    public $URL_UPDATE_PERMIS = '/api/v1/callNamePage';
    public $client_key;
    public $client_secretkey;
    public $client_domain;
    public $client_ip;
    public $client_ip_router;

    public function __construct($client_key=null,$client_secretkey=null,$client_domain=null,$client_ip=null,$client_ip_router=null)
    {
        $this->client_key = $client_key;
        $this->client_secretkey = $client_secretkey;
        $this->client_domain = $client_domain;
        $this->client_ip = encodeStrOneaccoount($client_ip);
        // $this->client_ip_router = encodeStr($_SERVER['SERVER_ADDR']);
        $this->client_ip_router = encodeStrOneaccoount($client_ip_router);
        $this->client_time = encodeStrOneaccoount(time());
    }

    public function getURLOneAccount()
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL =>  $this->URL_GET_ONE_ACCOUNT,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_SSL_VERIFYPEER => false
        ));


        $response = curl_exec($curl);
        if($response === false)
        {
            $response = curl_error($curl);
        }

        curl_close($curl);
        $response = json_decode($response);
        if ($response->Result == true) {
          //$this->URL_OAUTH_ACCESS_TOKEN = $response->data[0]->url.$this->URL_OAUTH_ACCESS_TOKEN;
          //$this->URL_GET_PROFILE = $response->data[0]->url.$this->URL_GET_PROFILE;
          //$this->URL_CHECK_USER = $response->data[0]->url.$this->URL_CHECK_USER;
          //$this->URL_CALL_NAME = $response->data[0]->url.$this->URL_CALL_NAME;
          $this->URL_CALL_NAME = 'https://oneaccount.dmcr.go.th/api/v1/callNamePage';
          $this->URL_OAUTH_ACCESS_TOKEN = 'https://oneaccount.dmcr.go.th/auth/v1/accessToken';
          $this->URL_GET_PROFILE = 'https://oneaccount.dmcr.go.th/auth/v1/getProfile';
          $this->URL_CHECK_USER = 'https://oneaccount.dmcr.go.th/auth/v1/checkUser';
          $this->URL_UPDATE_PERMIS = 'https://oneaccount.dmcr.go.th/auth/v1/updatePermission';
        }else{
          //$this->URL_OAUTH_ACCESS_TOKEN = 'https://oneaccount.dmcr.go.th/auth/v1/accessToken';
          //$this->URL_GET_PROFILE = 'https://oneaccount.dmcr.go.th/auth/v1/getProfile';
          //$this->URL_CHECK_USER = 'https://oneaccount.dmcr.go.th/auth/v1/checkUser';
          $this->URL_CALL_NAME = 'https://oneaccount.dmcr.go.th/api/v1/callNamePage';
          $this->URL_OAUTH_ACCESS_TOKEN = 'https://oneaccount.dmcr.go.th/auth/v1/accessToken';
          $this->URL_GET_PROFILE = 'https://oneaccount.dmcr.go.th/auth/v1/getProfile';
          $this->URL_CHECK_USER = 'https://oneaccount.dmcr.go.th/auth/v1/checkUser';
          $this->URL_UPDATE_PERMIS = 'https://oneaccount.dmcr.go.th/auth/v1/updatePermission';

        }
    }

    public function getTokenForLogin($username = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->URL_OAUTH_ACCESS_TOKEN,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "client_key=$this->client_key&client_secret=$this->client_secretkey&client_domain=$this->client_domain&client_ip=$this->client_ip&client_ip_router=$this->client_ip_router&client_time=$this->client_time&username=$username",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded"
          )
        ));
        
        $response = curl_exec($curl);
        if($response === false)
        {
            $response = curl_error($curl);
        }
        curl_close($curl);
        return $response;
    }
/*
    public function loginWebSite($username=null, $password=null, $token=null)
    {
     // echo "username=$username&password=$password&client_key=$this->client_key&client_secret=$this->client_secretkey&client_domain=$this->client_domain&client_ip=$this->client_ip&client_ip_router=$this->client_ip_router&client_time=$this->client_time";
      //  exit();
	  $data = json_encode(array(
		"username"  => $username,
		"password" => $password,
		"client_key" => $this->client_key,
		"client_secret" => $this->client_secretkey,
		"client_domain" => $this->client_domain,
		"client_ip" => $this->client_ip,
		"client_ip_router" => $this->client_ip_router,
		"client_time" => $this->client_time
		));
      $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->URL_GET_PROFILE,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "username=$username&password=$password&client_key=$this->client_key&client_secret=$this->client_secretkey&client_domain=$this->client_domain&client_ip=$this->client_ip&client_ip_router=$this->client_ip_router&client_time=$this->client_time",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "Authorization: Bearer ".$token
          )
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
*/

    public function loginWebSite($username=null, $password=null, $token=null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->URL_GET_PROFILE,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_CUSTOMREQUEST => "POST",
          // CURLOPT_POSTFIELDS => "username=$username&password=$password&client_key=$this->client_key&client_secret=$this->client_secretkey&client_domain=$this->client_domain&client_ip=$this->client_ip&client_ip_router=$this->client_ip_router&client_time=$this->client_time",
          CURLOPT_POSTFIELDS => array(
            "username" => $username,
            "password" => $password,
            "client_key" => $this->client_key,
            "client_secret" => $this->client_secretkey,
            "client_domain" => $this->client_domain,
            "client_ip" => $this->client_ip,
            "client_ip_router" => $this->client_ip_router,
            "client_time" => $this->client_time,
          ),
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "Authorization: Bearer ".$token
          )
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }



    public function checkUsername($username=null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->URL_CHECK_USER,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "username=$username",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          )
        ));

        $response = curl_exec($curl);
        if($response === false){
            $response = curl_error($curl);
        }
        curl_close($curl);

        return $response;
    }

    public function updatePermission($username=null,$status=null)
    {
      //echo $this->URL_UPDATE_PERMIS."username=$username&status=$status&client_key=$this->client_key&client_secret=$this->client_secretkey&client_domain=$this->client_domain&client_ip=$this->client_ip&client_ip_router=$this->client_ip_router&client_time=$this->client_time";
      //exit();
      $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->URL_UPDATE_PERMIS,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "username=$username&status=$status&client_key=$this->client_key&client_secret=$this->client_secretkey&client_domain=$this->client_domain&client_ip=$this->client_ip&client_ip_router=$this->client_ip_router&client_time=$this->client_time",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          )
        ));

        $response = curl_exec($curl);
        if($response === false){
            $response = curl_error($curl);
        }
        curl_close($curl);

        return $response;
    }
    public function callNMX()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->URL_CALL_NAME,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          )
        ));

        $response = curl_exec($curl);
        if($response === false){
            $response = curl_error($curl);
        }
        curl_close($curl);

        return $response;
    }
}