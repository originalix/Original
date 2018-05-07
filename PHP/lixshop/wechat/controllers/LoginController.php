<?php

namespace wechat\controllers;

use Yii;
use wechat\components\BaseController;
use QCloud_WeApp_SDK\Auth\LoginService as LoginService;
use QCloud_WeApp_SDK as Constants;

class LoginController extends BaseController
{
    public function actionIndex()
    {
        return [
            'code' => 200
        ];
    }
}
