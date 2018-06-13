<?php

namespace common\models;

use Yii;
use common\models\Coupon;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%sales_coupon_usage}}".
 *
 * @property int $id
 * @property int $coupon_id 优惠券id
 * @property int $is_used 是否使用过,1未使用，2使用过
 * @property string $created_at
 * @property string $updated_at 
 * @property int $customer_id 顾客用户id
 */
class CouponUsage extends \yii\db\ActiveRecord
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
        return '{{%sales_coupon_usage}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coupon_id', 'customer_id'], 'required'],
            [['coupon_id', 'customer_id', 'is_used'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'is_used' => '是否使用过,1未使用，2使用过',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCoupon()
    {
        return $this->hasOne(Coupon::className(), ['id' => 'coupon_id']);
    }
}
