<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%charge_product}}".
 *
 * @property int $id
 * @property int $amount 充值金额
 * @property int $gift 充值赠送金额
 * @property int $discount 充值折扣，请输入整数百分比
 * @property string $created_at
 * @property string $updated_at
 */
class ChargeProduct extends \yii\db\ActiveRecord
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
        return '{{%charge_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount', 'gift', 'discount'], 'integer'],
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
            'amount' => '充值金额',
            'gift' => '充值赠送金额',
            'discount' => '充值折扣，请输入整数百分比',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
