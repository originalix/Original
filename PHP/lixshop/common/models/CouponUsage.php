<?php

namespace common\models;

use Yii;
use common\models\Coupon;

/**
 * This is the model class for table "{{%sales_coupon_usage}}".
 *
 * @property int $id
 * @property int $coupon_id 优惠券id
 * @property int $customer_id 顾客用户id
 * @property int $times_used 使用次数
 */
class CouponUsage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sales_coupon_usage}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coupon_id', 'customer_id', 'times_used'], 'required'],
            [['coupon_id', 'customer_id', 'times_used'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coupon_id' => '优惠券id',
            'customer_id' => '顾客用户id',
            'times_used' => '使用次数',
        ];
    }

    public function getCoupon()
    {
        return $this->hasOne(Coupon::className(), ['id' => 'coupon_id']);
    }
}
