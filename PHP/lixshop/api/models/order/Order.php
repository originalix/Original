<?php

namespace api\models\order;

use Yii;
use common\models\SalesFlatOrder;
use common\models\SalesFlatOrderItem;

class Order extends SalesFlatOrder
{
    public function rules()
    {
        return [
            [['items_count', 'total_amount', 'discount_amount', 'real_amount', 'trade_no', 'userName', 'province', 'city', 'tel_number','txn_type', 'express_amount', 'express_type', 'express_date', 'express_time'], 'required', 'message' => '{attribute}未提交'],
            [['increment_id', 'items_count', 'customer_id', 'order_status', 'coupon_id'], 'integer'],
            [['total_amount', 'discount_amount', 'real_amount', 'express_amount'], 'number'],
            [['customer_name'], 'string', 'max' => 100],
            [['remote_ip'], 'string', 'max' => 50],
            [['coupon_code', 'order_remark'], 'string', 'max' => 255],
            [['payment_method', 'txn_type'], 'string', 'max' => 20],
            [['txn_id'], 'string', 'max' => 255],
        ];
    }
}
