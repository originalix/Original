<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\customer\AddCustomer;

class AuthController extends BaseController
{
    public function actionCreate()
    {
        $addCustomer = new AddCustomer();
        // $addCustomer->openId = $request->post('openId');
        // $addCustomer->mobile = $request->post('mobile');

        if ($addCustomer->load(Yii::$app->request->post())) {
            return ['msg' => '认证成功'];
            if ($customer = $addCustomer->signup()) {
                return $customer;
            }
        }

        print_r($addCustomer);
        exit();

        return ['msg' => $addCustomer->getFirstErrors()];
    }
}
