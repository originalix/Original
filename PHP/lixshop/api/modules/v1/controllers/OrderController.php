<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\order\Order;
use api\models\order\OrderItem;
use api\models\order\OrderForm;
use api\models\order\OrderSearch;

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
        $type = Yii::$app->request->get('type');
        if (is_null($type)) {
            $type = 0;
        }
        $model = new OrderSearch();
        $model->type = $type;
        return $model->search();
    }
}

