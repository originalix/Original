<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\order\Order;
use api\models\order\OrderItem;

class OrderController extends BaseController
{
    public function actionCreate()
    {
        $order = new Order();
        $order->setAttributes(Yii::$app->request->post());
        return $order;
    }
}
