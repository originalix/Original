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
        return ['code' => 418, 'data' => $headers];
    }
}
