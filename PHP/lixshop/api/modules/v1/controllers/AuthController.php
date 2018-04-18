<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\customer\AddCustomer;
use yii\web\HttpException;

class AuthController extends BaseController
{
    public function actionCreate()
    {
        $addCustomer = new AddCustomer();
        $addCustomer->openId = Yii::$app->request->post('openId');
        $addCustomer->mobile = Yii::$app->request->post('mobile');
        
        $customer = $addCustomer->signup();

        if (is_null($customer)) {
            throw new HttpException(418, '生成用户信息失败');
        }

        return $customer;
    }
}
