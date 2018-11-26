<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\order\Order;
use api\models\order\OrderItem;
use api\models\order\OrderForm;
use api\models\order\OrderSearch;
use yii\web\HttpException;

class OrderController extends BaseController
{
    /**
     *  创建订单接口
     */
    public function actionCreate()
    {
        // return json_encode(Yii::$app->request->post());
        $model = new OrderForm();
        if (! $model->load(Yii::$app->request->post(), '')) {
            throw new \yii\web\HttpException(420, '创建订单失败');
        }
        $model->customer_id = $this->user->id;
        return $model->save();
    }

    /**
     *  获取订单列表接口
     */
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

    public function actionDetail()
    {
        $id = Yii::$app->request->get('id');
        if (is_null($id)) {
            throw new HttpException(201, '请求参数缺失');
        }
        $model = new OrderSearch();
        return $model->detail($id);
    }
}

