<?php

namespace Censanet\GetnetBundle\Getnet;

/**
 * Class Request
 * @package Getnet\API
 */
class Request {

    /**
     * Base url from api
     *
     * @var string
     */
    private $baseUrl = '';

    /**
     * Request constructor.
     * @param Getnet $credentials
     */
    function __construct(Getnet $credentials) {

        if ($credentials->getEnv() == "PROD")
            $this->baseUrl = 'https://api.getnet.com.br';
        elseif ($credentials->getEnv() == "HOMOLOG")
            $this->baseUrl = 'https://api-homologacao.getnet.com.br';
        elseif ($credentials->getEnv() == "SANDBOX")
            $this->baseUrl = 'https://api-sandbox.getnet.com.br';
       
        //$credentials->debug($this->baseUrl);
       

        if (empty($credentials->getEnv()))
            return $this->auth($credentials);
    }

    /**
     * @param Getnet $credentials
     * @return Getnet
     * @throws Exception
     */
    function auth(Getnet $credentials) {
        $url_path = "/auth/oauth/v2/token";

        $params = [
            "scope" => "oob",
            "grant_type" => "client_credentials"
        ];

        $querystring = http_build_query($params);
        $response = $this->send($credentials, $url_path, 'AUTH', $querystring);
        $credentials->setAccessToken($response["access_token"]);
        $expirateTime = $response['expires_in'];
        $credentials->setValidate(strtotime('now') + $expirateTime);

        return $credentials;
    }

    /**
     * @param Getnet $credentials
     * @param $url_path
     * @param $method
     * @param null $json
     * @return mixed
     * @throws \Exception
     */
    private function send(Getnet $credentials, $url_path, $method, $json = NULL) {
        
        $credentials->debug($this->getFullUrl($url_path));
        $credentials->debug($json);
        $curl = curl_init($this->getFullUrl($url_path));

        $defaultCurlOptions = array(
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json; charset=utf-8', 'accept-encoding: 1'),
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => 0
        );
        
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);

        if ($method == 'POST') {
            $defaultCurlOptions[CURLOPT_HTTPHEADER][] = 'Authorization: Bearer ' . $credentials->getAccessToken();
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        } elseif ($method == 'PUT') {
            $defaultCurlOptions[CURLOPT_HTTPHEADER][] = 'Authorization: Bearer ' . $credentials->getAccessToken();
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        } elseif ($method == 'AUTH') {
            $defaultCurlOptions[CURLOPT_HTTPHEADER][0] = 'application/x-www-form-urlencoded';
            curl_setopt($curl, CURLOPT_USERPWD, $credentials->getClientId() . ":" . $credentials->getClientSecret());
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        }elseif($method == 'PATCH'){
            $defaultCurlOptions[CURLOPT_HTTPHEADER][] = 'Authorization: Bearer ' . $credentials->getAccessToken();
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        }else{
            $defaultCurlOptions[CURLOPT_HTTPHEADER][] = 'Authorization: Bearer ' . $credentials->getAccessToken();
        }
        
        if($method != 'AUTH'){
            $defaultCurlOptions[CURLOPT_HTTPHEADER][] = 'seller_id: '. $credentials->getSellerId();
        }
        curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt_array($curl, $defaultCurlOptions);

//        if ($credentials->getDebug() === true) {
//            $info = curl_getinfo($curl);
//            print_r($info);
//            curl_setopt($curl, CURLOPT_VERBOSE, 1);
//        }

        try {
            $response = curl_exec($curl);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
        

        $credentials->debug(json_decode($response, JSON_PRETTY_PRINT));
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($code >= 400) {
            $information = curl_getinfo($curl);            
            $credentials->debug($information);
            throw new Exception($response, $code);
        }
        if (!$response) {
            throw new Exception("Falha ao efetuar transação");
        }
        curl_close($curl);

        return json_decode($response, true);
    }

    /**
     * Get request full url
     *
     * @param string $url_path
     * @return string $url(config) + $url_path
     */
    private function getFullUrl($url_path) {
        if (stripos($url_path, $this->baseUrl, 0) === 0) {
            return $url_path;
        }

        return $this->baseUrl . $url_path;
    }

    /**
     * @return string
     */
    public function getBaseUrl() {
        return $this->baseUrl;
    }

    /**
     * @param Getnet $credentials
     * @param $url_path
     * @return mixed
     * @throws Exception
     */
    function get(Getnet $credentials, $url_path) {
        return $this->send($credentials, $url_path, 'GET');
    }

    /**
     * @param Getnet $credentials
     * @param $url_path
     * @param $params
     * @return mixed
     * @throws Exception
     */
    function post(Getnet $credentials, $url_path, $params=null) {
        return $this->send($credentials, $url_path, 'POST', $params);
    }

    /**
     * @param Getnet $credentials
     * @param $url_path
     * @param $params
     * @return mixed
     * @throws Exception
     */
    function put(Getnet $credentials, $url_path, $params) {
        return $this->send($credentials, $url_path, 'PUT', $params);
    }
    
    /**
     * @param Getnet $credentials
     * @param $url_path
     * @param $params
     * @return mixed
     * @throws Exception
     */
    function patch(Getnet $credentials, $url_path, $params) {
        return $this->send($credentials, $url_path, 'PATCH', $params);
    }

}
