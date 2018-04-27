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
        
        // return $model->checkCoupon();
        // return $model->save();
        return $model->save1();
    }

    /*
     * items_count
     * total_amount
     * discount_amount
     * real_amount
     * coupon_code
     * payment_method
     * address_id
     * order_remark
     * txn_type
     * 
     * orderItem 
     * {
     *      [
     *      'product_id',
     *      'count'
     *      'price'
     *      'row_total'
     *      ]
     * }
     */
}
