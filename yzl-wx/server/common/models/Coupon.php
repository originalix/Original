<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%sales_coupon}}".
 *
 * @property int $id
 * @property string $created_person 创建人
 * @property string $coupon_name 优惠券名称
 * @property string $coupon_description 优惠券描述
 * @property string $coupon_code 优惠券码
 * @property string $expiration_date 过期时间
 * @property int $users_per_customer 每个用户可以使用的次数
 * @property int $times_used 被使用的次数
 * @property int $type 优惠劵的类型，1代表按照百分比对产品打折，2代表在总额上减少多少
 * @property int $conditions 优惠劵使用的条件，如果类型为1，则没有条件，如果类型是2，则购物车中产品总额满足多少的时候进行打折。这里填写的是金额
 * @property int $discount 优惠劵的折扣，如果类型为1，这里填写的是百分比，如果类型是2，这里代表的是在总额上减少的金额
 * @property string $created_at
 * @property string $updated_at
 */
class Coupon extends \yii\db\ActiveRecord
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
        return '{{%sales_coupon}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_person', 'coupon_name', 'coupon_code'], 'required'],
            [['coupon_description'], 'string'],
            [['expiration_date', 'created_at', 'updated_at'], 'safe'],
            [['users_per_customer', 'times_used', 'type', 'conditions', 'discount'], 'integer'],
            [['created_person'], 'string', 'max' => 100],
            [['coupon_name', 'coupon_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_person' => '创建人',
            'coupon_name' => '优惠券名称',
            'coupon_description' => '优惠券描述',
            'coupon_code' => '优惠券码',
            'expiration_date' => '过期时间',
            'users_per_customer' => '每个用户可以使用的次数',
            'times_used' => '被使用的次数',
            'type' => '优惠劵的类型，1代表按照百分比对产品打折，2代表在总额上减少多少',
            'conditions' => '优惠劵使用的条件，如果类型为1，则没有条件，如果类型是2，则购物车中产品总额满足多少的时候进行打折。这里填写的是金额',
            'discount' => '优惠劵的折扣，如果类型为1，这里填写的是百分比，如果类型是2，这里代表的是在总额上减少的金额',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
