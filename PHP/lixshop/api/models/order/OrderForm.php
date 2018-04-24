<?php

namespace api\models\order;

use Yii;
use common\models\SalesFlatOrder;
use common\models\SalesFlatOrderItem;
use yii\base\Model;

class OrderForm extends Model
{
    public $order_status;
    public $items_count;
    public $total_amount;
    public $discount_amount;
    public $real_amount;
    public $customer_id;
    public $customer_group;
    public $customer_name;
    public $remote_ip;
    public $coupon_code;
    public $payment_method;
    public $address_id;
    public $order_remark;
    public $txn_type;
    public $txn_id;

    public function rules()
    {
        return [
            [['items_count', 'total_amount', 'discount_amount', 'real_amount', 'payment_method', 'address_id', 'txn_type'], 'required', 'message' => '{attribute}未提交'],
            [['increment_id', 'items_count', 'customer_id', 'address_id'], 'integer'],
            [['total_amount', 'discount_amount', 'real_amount'], 'number'],
            [['customer_name'], 'string', 'max' => 100],
            [['remote_ip'], 'string', 'max' => 50],
            [['coupon_code'], 'string', 'max' => 255],
            [['payment_method', 'txn_type'], 'string', 'max' => 20],
            [['txn_id'], 'string', 'max' => 255],
        ];
    }

    
}
