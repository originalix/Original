<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\customer\AddCustomer;
use common\models\Customer;
use yii\web\HttpException;

class AuthController extends BaseController
{
    public function actionToken()
    {
        $addCustomer = new AddCustomer();
        $addCustomer->openId = Yii::$app->request->get('openId');
        $addCustomer->mobile = Yii::$app->request->get('mobile');
        
        $customer = $addCustomer->signup();

        if (is_null($customer)) {
            throw new HttpException(418, '生成用户信息失败');
        }

        if (is_string($customer)) {
            throw new HttpException(419, $customer);
        }

        return $customer;
    }
}
