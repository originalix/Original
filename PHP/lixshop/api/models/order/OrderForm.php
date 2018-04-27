<?php

namespace api\models\order;

use Yii;
use api\models\order\Order;
use yii\base\Model;
use yii\web\HttpException;
use yii\db\Exception;
use api\models\order\OrderItem;
use api\models\order\OrderItemForm;
use api\models\product\ProductInfo;

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
    public $increment_id;

    public function rules()
    {
        return [
            // [['items_count', 'total_amount', 'discount_amount', 'real_amount', 'payment_method', 'address_id', 'txn_type'], 'required', 'message' => '{attribute}未提交'],
            
            [['increment_id', 'items_count', 'customer_id', 'address_id'], 'integer'],
            [['total_amount', 'discount_amount', 'real_amount'], 'number'],
            [['customer_name'], 'string', 'max' => 100],
            [['remote_ip'], 'string', 'max' => 50],
            [['coupon_code'], 'string', 'max' => 255],
            [['payment_method', 'txn_type'], 'string', 'max' => 20],
            // [['txn_id'], 'string', 'max' => 255],
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

    public function calculateAmount()
    {
        $products = [];
        $total_amount = 0;
        $discount_amount = 0;
        $real_amount = 0;
        foreach ($this->orderItems as $items) {
            $count = isset($items['count']) ? $items['count'] : 1;

            $product = ProductInfo::findOne($items["product_id"]);
            $total_amount += $product->price * $count;
            $real_amount += $product->final_price * $count;
            array_push($products, $product);
        }
        $discount_amount = $total_amount - $real_amount;

        // return $products;

        // $products = ProductInfo::find()->where(['id' => $product_ids])->all();
        // foreach ($products as $product)
        // {
        //     $total_amount += $product->price;
        //     $real_amount += $product->final_price;
        // }
        return [
            'total_amount' => $total_amount,
            'real_amount' => $real_amount,
            'discount_amount' => $discount_amount,
        ];
    }

    public function save1()
    {
        if (! $this->validate()) {
            throw new HttpException(418, array_values($this->getFirstErrors())[0]);
        }

        // 生成order model 并保存
        $order = $this->createOrderModel();

        // 开启事务
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (! $order->save()) {
                throw new HttpException(418, '订单保存失败');
            }

            if ($this->orderItems) {
                // 循环产品 orderItems
                foreach ($this->orderItems as $item) {
                    $_orderItem = clone $orderItem;
                    $_orderItem->load($item, '');
                    if (! $_orderItem->saveWithOrder($model)) {
                        throw new Exception('订单产品保存失败');
                    }
                }
                    // 每个产品 记录信息 保存model
                    // 每个产品 按数量 减少库存
                    // 对应的custom_option_key 库存减少
                // 保存order Items
                $orderItem = new OrderItemForm();
            }

            // 事务结束
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new HttpException(418, $e->getMessage());
        }

        return $model->attributes;
    }

    protected function createOrderModel()
    {
        $model = new Order();
        $model->attributes = [
            'order_status' => 1,
            'items_count' => $this->items_count,
            'total_amount' => $this->total_amount,
            'discount_amount' => $this->discount_amount,
            'real_amount' => $this->real_amount,
            'customer_id' => $this->customer_id,
            // 'customer_group' => $this->customer_group,
            // 'customer_name' => $this->customer_name,
            'remote_ip' => $this->remote_ip,
            'coupon_code' => $this->coupon_code,
            'payment_method' => $this->payment_method,
            'address_id' => $this->address_id,
            'order_remark' => $this->order_remark,
            'txn_type' => $this->txn_type,
        ];

        return $model;
    }

    public function save()
    {
        if (! $this->validate()) {
            // throw new HttpException(418, '保存订单失败');
            throw new HttpException(418, array_values($this->getFirstErrors())[0]);
        }

        $model = new Order();
        $model->attributes = [
            'order_status' => 1,
            'items_count' => $this->items_count,
            'total_amount' => $this->total_amount,
            'discount_amount' => $this->discount_amount,
            'real_amount' => $this->real_amount,
            'customer_id' => $this->customer_id,
            // 'customer_group' => $this->customer_group,
            // 'customer_name' => $this->customer_name,
            'remote_ip' => $this->remote_ip,
            'coupon_code' => $this->coupon_code,
            'payment_method' => $this->payment_method,
            'address_id' => $this->address_id,
            'order_remark' => $this->order_remark,
            'txn_type' => $this->txn_type,
        ];

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (! $model->save()) {
                throw new HttpException(418, '订单保存失败');
            }

            if ($this->orderItems) {
                // 保存order Items
                $orderItem = new OrderItemForm();
                foreach ($this->orderItems as $item) {
                        $_orderItem = clone $orderItem;
                        $_orderItem->load($item, '');
                    if (! $_orderItem->saveWithOrder($model)) {
                        throw new Exception('订单产品保存失败');
                    }
                }
            }

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new HttpException(418, $e->getMessage());
        }

        return $model->attributes;
    }
}
