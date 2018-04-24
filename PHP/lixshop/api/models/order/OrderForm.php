<?php

namespace api\models\order;

use Yii;
use api\models\order\Order;
use yii\base\Model;
use yii\web\HttpException;
use api\models\order\OrderItem;

class OrderForm extends Model
{
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
    public $orderItems;

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
            [['orderItems'], 'validateOrderItems']
        ];
    }

    public function validateOrderItems($attribute)
    {
        if (! $this->hasErrors() && !empty($this->attribute)) {
            return true;
        }

        return false;
    }

    public function save()
    {
        if (! $this->validate()) {
            throw new HttpException(418, '保存订单失败');
        }

        $model = new Order();
        $model->attributes = [
            'order_status' => 1,
            'items_count' => $this->items_count,
            'total_amount' => $this->total_amount,
            'discount_amount' => $this->discount_amount,
            'real_amount' => $this->real_amount,
            'customer_id' => $this->customer_id,
            'customer_group' => $this->customer_group,
            'customer_name' => $this->customer_name,
            'remote_ip' => $this->remote_ip,
            'coupon_code' => $this->coupon_code,
            'payment_method' => $this->payment_method,
            'address_id' => $this->address_id,
            'order_remark' => $this->order_remarkm,
            'txn_type' => $this->txn_type,
        ];

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (! $model->save()) {
                throw new HttpException(418, '订单保存失败');
            }

            if ($this->orderItems) {
                // 保存order Items
            }
        }
    }
}
