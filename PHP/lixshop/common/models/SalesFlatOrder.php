<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\SalesFlatOrderItem;
use common\models\Coupon;

/**
 * This is the model class for table "{{%sales_flat_order}}".
 *
 * @property int $id
 * @property int $increment_id 自动增长id
 * @property int $order_status 订单状态，1待付款，2已付款，3已完成
 * @property int $items_count 订单商品数量
 * @property string $total_amount 订单总价
 * @property string $discount_amount 折扣价格
 * @property string $real_amount 该订单的真实成交价格
 * @property int $customer_id 顾客id
 * @property int $customer_group 顾客分组
 * @property string $customer_name 顾客姓名
 * @property string $remote_ip ip地址
 * @property string $coupon_code 优惠券码
 * @property string $payment_method 支付方式
 * @property string $order_remark 交易备注
 * @property string $txn_type Transaction类型，是在购物车点击支付按钮下单，还是在下单页面填写完货运地址信息下单
 * @property string $txn_id Transaction Id 支付平台唯一交易号,通过这个可以在第三方支付平台查找订单
 * @property string $created_at
 * @property string $updated_at
 * @property string $trade_no 32位以内订单编号
 * @property string $userName 收件人姓名
 * @property string $province 省
 * @property string $city 市
 * @property string $county 区
 * @property string $street 详细地址
 * @property string $postal_code 邮编
 * @property string $tel_number 电话号码
 * @property string $express_amount 快递金额
 * @property int $express_type 配送方式，0上门配送,1到店取送
 * @property string $express_date 配送日期
 * @property string $express_time 配送时段
 * @property int $coupon_id 优惠券id
 */
class SalesFlatOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {        
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',// 自己根据数据库字段修改
                'updatedAtAttribute' => 'updated_at', // 自己根据数据库字段修改
                'value' => date('Y-m-d H:i:s'), // 自己根据数据库字段修改
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sales_flat_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['increment_id', 'order_status', 'items_count', 'customer_id', 'customer_group', 'express_type', 'coupon_id'], 'integer'],
            [['total_amount', 'discount_amount', 'real_amount', 'express_amount'], 'number'],
            [['payment_method', 'trade_no', 'userName'], 'required'],
            [['order_remark'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['customer_name'], 'string', 'max' => 100],
            [['remote_ip'], 'string', 'max' => 50],
            [['coupon_code', 'street'], 'string', 'max' => 255],
            [['payment_method', 'txn_type'], 'string', 'max' => 20],
            [['txn_id'], 'string', 'max' => 30],
            [['trade_no', 'userName', 'province', 'city', 'county', 'postal_code', 'tel_number', 'express_date', 'express_time'], 'string', 'max' => 32],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'increment_id' => '自动增长id',
            'order_status' => '订单状态，1待付款，2已付款，3已完成',
            'items_count' => '订单商品数量',
            'total_amount' => '订单总价',
            'discount_amount' => '折扣价格',
            'real_amount' => '该订单的真实成交价格',
            'customer_id' => '顾客id',
            'customer_group' => '顾客分组',
            'customer_name' => '顾客姓名',
            'remote_ip' => 'ip地址',
            'coupon_code' => '优惠券码',
            'payment_method' => '支付方式',
            'order_remark' => '交易备注',
            'txn_type' => 'Transaction类型，是在购物车点击支付按钮下单，还是在下单页面填写完货运地址信息下单',
            'txn_id' => 'Transaction Id 支付平台唯一交易号,通过这个可以在第三方支付平台查找订单',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'trade_no' => '32位以内订单编号',
            'userName' => '收件人姓名',
            'province' => '省',
            'city' => '市',
            'county' => '区',
            'street' => '详细地址',
            'postal_code' => '邮编',
            'tel_number' => '电话号码',
            'express_amount' => '快递金额',
            'express_type' => '配送方式',
            'express_date' => '配送日期',
            'express_time' => '配送时段',
            'coupon_id' => '优惠券关联id',
        ];
    }

    public function getItems()
    {
        return $this->hasMany(SalesFlatOrderItem::className(), ['order_id' => 'id']);
    }

    public function getCoupon()
    {
        return $this->hasOne(Coupon::className(), ['id' => 'coupon_id']);
    }
}
