<?php

namespace wechat\controllers;

use Yii;
use wechat\components\BaseController;
use QCloud_WeApp_SDK\Auth\LoginService as LoginService;
use QCloud_WeApp_SDK\Constants as Constants;

class LoginController extends BaseController
{
    public function actionIndex()
    {
        $result = LoginService::login();
        
        if ($result['loginState'] === Constants::S_AUTH) {
            return ['code' => 0, 'data' => $result['userinfo']];
        } else {
            return ['code' => -1, 'error' => $result['error']];
        }
    }

    public function actionTest()
    {
        $headers = apache_request_headers();
        $diyHeaders = $this->getAllHeaders();
        if (is_array($diyHeaders)) {
            $headers = array_merge($headers, $diyHeaders);
        }
        return ['code' => 418, 'data' => $headers];
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
}
