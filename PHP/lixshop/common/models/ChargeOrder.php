<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%charge_order}}".
 *
 * @property int $id
 * @property int $trade_no 订单号
 * @property int $order_status 订单状态，1未付款，2已付款，3已完成
 * @property string $total_amount 订单总价
 * @property string $discount_amount 折扣价格
 * @property string $real_amount 该订单的真实成交价格
 * @property int $customer_id 顾客id
 * @property int $customer_group 顾客分组
 * @property string $remote_ip ip地址
 * @property string $payment_method 支付方式
 * @property string $txn_id Transaction Id 支付平台唯一交易号,通过这个可以在第三方支付平台查找订单
 * @property string $created_at
 * @property string $updated_at
 */
class ChargeOrder extends \yii\db\ActiveRecord
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
        return '{{%charge_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trade_no', 'order_status', 'customer_id', 'customer_group'], 'integer'],
            [['total_amount', 'discount_amount', 'real_amount'], 'number'],
            [['payment_method'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['remote_ip'], 'string', 'max' => 50],
            [['payment_method'], 'string', 'max' => 20],
            [['txn_id'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trade_no' => '订单号',
            'order_status' => '订单状态，1未付款，2已付款，3已完成',
            'total_amount' => '订单总价',
            'discount_amount' => '折扣价格',
            'real_amount' => '该订单的真实成交价格',
            'customer_id' => '顾客id',
            'customer_group' => '顾客分组',
            'remote_ip' => 'ip地址',
            'payment_method' => '支付方式',
            'txn_id' => 'Transaction Id 支付平台唯一交易号,通过这个可以在第三方支付平台查找订单',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
