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
use common\models\Customer;
use common\models\SalePromotion;

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
    public $couponUsage = null;
    public $coupon_code;
    public $coupon_id;
    public $payment_method;
    public $order_remark;
    public $txn_type;
    public $orderItems;
    public $increment_id;
    public $trade_no;
    public $userName;
    public $province;
    public $city;
    public $county;
    public $street;
    public $postal_code;
    public $tel_number;
    public $express_amount;
    public $express_type;
    public $express_date;
    public $express_time;
    public $promotion_id = null;

    public function rules()
    {
        return [
            // [['items_count', 'total_amount', 'discount_amount', 'real_amount', 'payment_method', 'address_id', 'txn_type'], 'required', 'message' => '{attribute}未提交'],
            
            [['increment_id', 'items_count', 'customer_id', 'coupon_id', 'express_type', 'promotion_id'], 'integer'],
            [['total_amount', 'discount_amount', 'real_amount', 'express_amount'], 'number'],
            [['customer_name'], 'string', 'max' => 100],
            [['remote_ip', 'trade_no', 'userName', 'province', 'city', 'county', 'postal_code', 'tel_number'], 'string', 'max' => 50],
            [['coupon_code', 'order_remark', 'street'], 'string', 'max' => 255],
            [['payment_method', 'txn_type'], 'string', 'max' => 20],
            // [['txn_id'], 'string', 'max' => 255],
            [['express_date', 'express_time'], 'string', 'max' => 32],
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

    /**
     * 计算商品价格
     *
     * @return void
     */
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
        }
        
        // 到店取送的情况 去掉运费
        if ($this->express_type === 1) {
            $this->express_amount = 0.00;
        } else {
            // 查看是否满足30元 否则需要邮费
            if ($this->total_amount > 30) {
                $this->express_amount = 0.00;
            } else {
                $this->express_amount = 10.00;
                $this->total_amount += 10.00;
                $this->real_amount += 10.00;
            }
        }

        // $this->checkCoupon();

        // 查询会员折扣，并且按照折扣打折
        $customer = Customer::findOne(Yii::$app->user->identity->id);
        if ($customer->discount !== 100) {
            $this->real_amount = $this->real_amount * ($customer->discount / 100);
        }

        // 计算折扣价格
        $this->discount_amount = $this->total_amount - $this->real_amount;
        // return [
        //     'total_amount' => $this->total_amount,
        //     'real_amount' => $this->real_amount,
        //     'discount_amount' => $this->discount_amount,
        // ];
    }

    /**
     * 查看有无可用优惠券
     *
     * @return void
     */
    public function checkCoupon()
    {
        if (is_null($this->coupon_id)) {
            // throw new HttpException(418, '没有优惠券id!');
            return;    
        }

        // $couponUsage = CouponUsage::findOne(1);
        $this->couponUsage = CouponUsage::find()->where(['customer_id' => $this->customer_id])
                        ->andWhere(['coupon_id' => $this->coupon_id])
                        ->andWhere(['is_used' => 1])
                        ->one();

        if (is_null($this->couponUsage)) {
            throw new HttpException(418, '优惠券无效或已被使用');
        }
        
        $coupon = $this->couponUsage->coupon;

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

    /**
     * 保存订单
     *
     * @return void
     */
    public function save()
    {
        // 计算商品价格
        $this->calculateAmount();
        $this->checkCoupon();
        // 真实价格上 加上运费
        // $this->real_amount += $this->express_amount;
        // 生成订单号
        $this->trade_no = $this->generatorTradeNo();
        
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
                // throw new HttpException(418, '订单保存失败');
                throw new HttpException(421, array_values($order->getFirstErrors())[0]);
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
                        throw new HttpException(422, '订单产品保存失败');
                        // throw new HttpException(422, array_values($_orderItem->getFirstErrors())[0]);
                    }
                }
                    // 每个产品 按数量 减少库存
                    // 对应的custom_option_key 库存减少
            }

            // 开始记录优惠券使用情况
            if (! is_null ($this->couponUsage)) {
                $this->couponUsage->is_used = 2;
                $coupon = $this->couponUsage->coupon;
                $coupon->times_used += 1;
                if (! $this->couponUsage->save()) {
                    throw new Exception('优惠券使用保存失败');
                }

                if (! $coupon->save()) {
                    throw new Exception('优惠券使用保存失败');
                }
            }

            // 事务结束
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new HttpException(421, $e->getMessage());
        }

        $this->calculatePromotion();

        return $order->attributes;
    }

    /**
     * 创建订单model
     *
     * @return void
     */
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
            'order_remark' => $this->order_remark,
            'txn_type' => $this->txn_type,
            'trade_no' => $this->trade_no,
            'userName' => $this->userName,
            'province' => $this->province,
            'city' => $this->city,
            'tel_number' => $this->tel_number,
            'express_amount' => $this->express_amount,
            'txn_type' => 'order',
            'express_type' => $this->express_type,
            'express_date' => $this->express_date,
            'express_time' => $this->express_time,
            'coupon_id' => $this->coupon_id,
        ];

        $model->county = $this->county;
        $model->street = $this->street;
        $model->postal_code = $this->postal_code;
        $model->express_type = $this->express_type;

        return $model;
    }

    protected function generatorTradeNo()
    {
        return date('Ymd', time()).time().mt_rand(1000,9999);
    }

    /**
     *  创建订单时，增加团购数量
     */
    protected function calculatePromotion()
    {
        if (is_null($this->promotion_id)) {
            return;
        }

        $sale_promotion = SalePromotion::findOne($this->promotion_id);
        if (is_null($sale_promotion)) {
            throw new HttpException(421, '团购商品不存在');
        }
        $sale_promotion->sale_count += 1;
        $sale_promotion->save();
    }
}

