<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\WxPay;

class WxpayController extends BaseController
{
    public function actionCreate()
    {
        $model = new WxPay();
        if ($model->load(Yii::$app->request->post(), '')) {
            return $model->pay();
        }
    }
}
