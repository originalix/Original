<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;

class AuthController extends BaseController
{
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $openId = $request->post('openId');
        $mobile = $request->post('mobile');


        return [
            
        ];
    }
}
