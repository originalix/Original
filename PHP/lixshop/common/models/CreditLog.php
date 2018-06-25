<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%credit_log}}".
 *
 * @property int $id
 * @property int $customer_id 顾客id
 * @property int $type 积分使用类型，1获取，2使用
 * @property string $amount 使用数量
 * @property string $mark 消费描述
 * @property string $balance 当前余额
 * @property string $created_at
 * @property string $updated_at
 */
class CreditLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%credit_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'type'], 'integer'],
            [['amount', 'balance'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['mark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => '顾客id',
            'type' => '积分使用类型，1获取，2使用',
            'amount' => '使用数量',
            'mark' => '消费描述',
            'balance' => '当前余额',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

