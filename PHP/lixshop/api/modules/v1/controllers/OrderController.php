<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\order\Order;
use api\models\order\OrderItem;
use api\models\order\OrderForm;

class OrderController extends BaseController
{
    public function actionCreate()
    {
        // return Yii::$app->request->post();
        $model = new OrderForm();
        if (! $model->load(Yii::$app->request->post(), '')) {
            throw new \yii\web\HttpException(420, '创建订单失败');
        }
        $model->customer_id = $this->user->id;
        return $model->save();
    }

    public function actionIndex()
    {

    }
}

