<?php
namespace ActiveOAuth2;

class Controller {

    public $state;
    public $provider;

    function __construct($provider)
    {
        $this->provider = $provider;
        $this->state = $this->getState();
    }

    public function getAuthorizationUrl()
    {
        $url = $this->provider['urlAuthorize'];
        $bodyRow = array(
            'state' => $this->state,
            'scope' => $this->provider['scopes'],
            'response_type' => 'code',
            'approval_prompt' => 'auto',
            'redirect_uri' => $this->provider['redirectUri'],
            'client_id' => $this->provider['clientId'],
        );
        $url = $url . '?' . http_build_query($bodyRow);
        return $url;
    }

    public function getState()
    {
        if (function_exists('random_bytes')) {
            return bin2hex(random_bytes(16));
        } else if (function_exists('openssl_random_pseudo_bytes')) {
            return bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $bytes = '';
            for ($i = 0; $i < 16; $i++) {
                $bytes .= chr(mt_rand(0, 255));
            }
            return bin2hex($bytes);
        }
    }

    public function sendCURL($url, $header, $type, $data = null)
    {
        $request = curl_init();
    
        if ($header != null) {
            curl_setopt($request, CURLOPT_HTTPHEADER, $header);
        }
    
        curl_setopt($request, CURLOPT_URL, $url);
        curl_setopt($request, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($request, CURLOPT_ENCODING, '');
        curl_setopt($request, CURLOPT_MAXREDIRS, 10);
        curl_setopt($request, CURLOPT_TIMEOUT, 0);
    
        if (strtoupper($type) === 'POST') {
            // curl_setopt($request, CURLOPT_POST, true);
            curl_setopt($request, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($request, CURLOPT_POSTFIELDS, json_encode($data));
        }
    
        curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($request);
        curl_close($request);

        $response = str_replace('}null', '}', $response);
        return !empty($response) ? json_decode($response) : $response;
    }
}