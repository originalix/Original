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
use common\models\CustomOptionStock;
use common\models\Coupon;
use common\models\CouponUsage;

class OrderForm extends Model
{
    public $items_count;
    public $total_amount = 0;
    public $discount_amount = 0;
    public $real_amount = 0;
    public $products = [];
    public $customer_id;
    public $customer_group;
    public $customer_name;
    public $remote_ip;
    public $coupon_code;
    public $coupon_id;
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
            
            [['increment_id', 'items_count', 'customer_id', 'address_id', 'coupon_id'], 'integer'],
            [['total_amount', 'discount_amount', 'real_amount'], 'number'],
            [['customer_name'], 'string', 'max' => 100],
            [['remote_ip'], 'string', 'max' => 50],
            [['coupon_code', 'order_remark'], 'string', 'max' => 255],
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
        // 计算总价
        foreach ($this->orderItems as $items) {
            // 宝贝数量
            $count = isset($items['count']) ? $items['count'] : 1;
            // 宝贝自选型号
            $custom_option_key = isset($items['custom_option_key']) ? $items['custom_option_key'] : null;

            // 查询产品
            $product = ProductInfo::findOne($items["product_id"]);

            // 查询宝贝自选型号价格
            if (! is_null($custom_option_key)) {
                $custom_option = CustomOptionStock::findByProductIdAndKey($items["product_id"], $custom_option_key);
                if (! is_null($custom_option)) {
                    $product->price = ($product->price > $custom_option->price) ? $product->price : $custom_option->price;
                    $product->final_price = $custom_option->price;
                }
            }
            // 计算总价格 真实价格
            $this->total_amount += $product->price * $count;
            $this->real_amount += $product->final_price * $count;
            array_push($this->products, $product);

            // 查看是否有优惠券 是否需要打折

            // 查看是否满足30元 否则需要邮费
        }

        $this->discount_amount = $this->total_amount - $this->real_amount;

        // return [
        //     'total_amount' => $this->total_amount,
        //     'real_amount' => $this->real_amount,
        //     'discount_amount' => $this->discount_amount,
        // ];
    }

    public function checkCoupon()
    {
        if (is_null($this->coupon_id)) {
            // throw new HttpException(418, '没有优惠券id!');
            return;    
        }

        // $couponUsage = CouponUsage::findOne(1);
        $couponUsage = CouponUsage::find()->where(['customer_id' => $this->customer_id])
                        ->andWhere(['coupon_id' => $this->coupon_id])
                        ->andWhere(['<', 'times_used', 1])
                        ->one();

        if (is_null($couponUsage)) {
            throw new HttpException(418, '优惠券无效或已被使用');
        }
        
        $coupon = $couponUsage->coupon;

        if (is_null($coupon)) {
            throw new HttpException(418, '没有优惠券！！！！');
            return;
        }

        if(strtotime(date("y-m-d h:i:s")) >= strtotime($coupon->expiration_date)){
            throw new HttpException(418, "优惠券已经过期");
        }

        $this->coupon_code = $coupon->coupon_name;

        // 是否达到满减条件
        if ($this->real_amount < $coupon->conditions) {
            throw new HttpException(418, "未达到满减条件");
        }

        // type 1 折扣 2 满减
        if ($coupon->type === 1) {
            // 打折
            $this->real_amount = $this->real_amount * ($coupon->discount / 100);
        } else if ($coupon->type === 2) {
            // 如果实际价格比折扣高，则满减，否则直接为0
            if ($this->real_amount >= $coupon->discount) {
                $this->real_amount -= $coupon->discount;
            } else {
                $this->real_amount = 0;
            }
        }

        $this->discount_amount = $this->total_amount - $this->real_amount;
    }

    public function save()
    {
        // 计算商品价格
        $this->calculateAmount();
        $this->checkCoupon();

        if (! $this->validate()) {
            throw new HttpException(418, array_values($this->getFirstErrors())[0]);
        }

        // 生成order model 并保存
        $order = $this->createOrderModel();
        // return $order;

        // 开启事务
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (! $order->save()) {
                throw new HttpException(418, '订单保存失败');
            }

            if ($this->orderItems) {
                // 循环产品 orderItems
                $orderItem = new OrderItemForm();
                foreach ($this->orderItems as $item) {
                    // 保存order Items
                    $_orderItem = clone $orderItem;
                    // 每个产品 记录信息 保存model
                    $_orderItem->load($item, '');
                    if (! $_orderItem->saveWithOrder($order)) {
                        throw new Exception('订单产品保存失败');
                    }
                }
                    // 每个产品 按数量 减少库存
                    // 对应的custom_option_key 库存减少
            }

            // 事务结束
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new HttpException(418, $e->getMessage());
        }

        return $order->attributes;
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
            'remote_ip' => Yii::$app->request->userIP,
            'coupon_code' => $this->coupon_code,
            'payment_method' => $this->payment_method,
            'address_id' => $this->address_id,
            'order_remark' => $this->order_remark,
            'txn_type' => $this->txn_type,
        ];

        return $model;
    }
