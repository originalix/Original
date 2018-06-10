<?php

namespace common\models;

use Yii;

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
