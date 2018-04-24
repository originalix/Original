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
