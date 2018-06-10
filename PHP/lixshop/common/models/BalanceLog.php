<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%balance_log}}".
 *
 * @property int $id
 * @property int $customer_id 顾客id
 * @property int $type 消费类型, 1消费，2充值
 * @property int $amount 消费金额
 * @property string $mark 消费描述
 * @property string $balance 当前余额
 * @property string $created_at
 * @property string $updated_at
 */
class BalanceLog extends \yii\db\ActiveRecord
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
        return '{{%balance_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'type', 'amount'], 'integer'],
            [['balance'], 'number'],
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
            'type' => '消费类型, 1消费，2充值',
            'amount' => '消费金额',
            'mark' => '消费描述',
            'balance' => '当前余额',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
