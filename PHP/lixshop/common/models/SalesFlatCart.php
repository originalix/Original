<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%sales_flat_cart}}".
 *
 * @property int $id
 * @property int $items_count 购物车中产品的总个数，默认为0个
 * @property int $customer_id 顾客id
 * @property string $customer_name 顾客姓名
 * @property int $customer_is_guest 是否为游客身份
 * @property string $remote_ip ip地址
 * @property string $coupon_code 优惠券码
 * @property string $created_at
 * @property string $updated_at
 */
class SalesFlatCart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sales_flat_cart}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['items_count', 'customer_id'], 'integer'],
            [['customer_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['customer_name'], 'string', 'max' => 11],
            [['customer_is_guest'], 'string', 'max' => 1],
            [['remote_ip', 'coupon_code'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'items_count' => '购物车中产品的总个数，默认为0个',
            'customer_id' => '顾客id',
            'customer_name' => '顾客姓名',
            'customer_is_guest' => '是否为游客身份',
            'remote_ip' => 'ip地址',
            'coupon_code' => '优惠券码',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
