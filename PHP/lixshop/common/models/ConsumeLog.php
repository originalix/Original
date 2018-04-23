<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%consume_log}}".
 *
 * @property int $id
 * @property int $customer_id 顾客id
 * @property string $consume 消费金额
 * @property string $created_at
 * @property string $updated_at
 */
class ConsumeLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%consume_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id'], 'required'],
            [['customer_id'], 'integer'],
            [['consume'], 'number'],
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
            'customer_id' => '顾客id',
            'consume' => '消费金额',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
