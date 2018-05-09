<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use QCloud_WeApp_SDK\Auth\LoginService as LoginService;
use QCloud_WeApp_SDK\Constants as Constants;
use Curl\Curl;

class Login extends CI_Controller {
    public function index() {
        // $headers = $this->apache_request_headers();
        // $diyHeaders = $this->getAllHeaders();
        // if (is_array($diyHeaders)) {
        //     $headers = array_merge($headers, $diyHeaders);
        // }

        $result = LoginService::login();
        
        if ($result['loginState'] === Constants::S_AUTH) {
            $this->json([
                'code' => 0,
                'data' => $result['userinfo'],
                // 'headers' => $headers
            ]);
        } else {
            $this->json([
                'code' => -1,
                'error' => $result['error'],
                // 'headers' => $headers
            ]);
        }
    }

    public function test() {
        $this->json([
            'code' => 2150
        ]);
    }

    protected function apache_request_headers() 
    {
        $arh = array();
        $rx_http = '/\AHTTP_/';
        foreach($_SERVER as $key => $val) {
            if( preg_match($rx_http, $key) ) {
            $arh_key = preg_replace($rx_http, '', $key);
            $rx_matches = array();
            // do some nasty string manipulations to restore the original letter case
            // this should work in most cases
            $rx_matches = explode('_', $arh_key);
            if( count($rx_matches) > 0 and strlen($arh_key) > 2 ) {
                foreach($rx_matches as $ak_key => $ak_val) $rx_matches[$ak_key] = ucfirst($ak_val);
                $arh_key = implode('-', $rx_matches);
            }
            $arh[$arh_key] = $val;
            }
        }
        return( $arh );
    }

    protected function getAllHeaders()
    {
        $headers = array(); 
        foreach ($_SERVER as $key => $value) { 
            if ('HTTP_' == substr($key, 0, 5)) { 
                $headers[str_replace('_', '-', substr($key, 5))] = $value; 
            } 
        }

        if (isset($_SERVER['PHP_AUTH_DIGEST'])) { 
            $header['AUTHORIZATION'] = $_SERVER['PHP_AUTH_DIGEST'];
        } elseif (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) { 
            $header['AUTHORIZATION'] = base64_encode($_SERVER['PHP_AUTH_USER'] . ':' . $_SERVER['PHP_AUTH_PW']); 
        } 
        if (isset($_SERVER['CONTENT_LENGTH'])) { 
            $header['CONTENT-LENGTH'] = $_SERVER['CONTENT_LENGTH']; 
        } 
        if (isset($_SERVER['CONTENT_TYPE'])) { 
            $header['CONTENT-TYPE'] = $_SERVER['CONTENT_TYPE']; 
        }
    }

    public function wx()
    {
        $this->json([
            'code' => 518
        ]);
        $curl = new Curl();
        // $curl->get('http://140.143.8.19/code-repo/PHP/lixshop/wechat/web/login/test');

        // if ($curl->error) {
        //     echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        // } else {
        //     echo 'Response:' . "\n";
        //     var_dump($curl->response);
        // }
    }
}
