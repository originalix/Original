<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\coupon\CouponLogic;
use yii\web\HttpException;

class CouponController extends BaseController
{
    public function actionIndex()
    {

    }

    public function actionExchange()
    {
        $code = Yii::$app->request->post('code');
        if (is_null($code)) {
            throw new HttpException(417, '请输入优惠券码');
        }

        $model = new CouponLogic();
        return $model->exchange($code);
    }
}

