<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;

class WXApiController extends BaseController
{
    public function actionIndex()
    {
        return ['msg' => 'this is WX API Controller'];
    }

    public function actionGetAccessToken()
    {
        
    }
}
