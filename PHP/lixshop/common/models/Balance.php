<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%balance}}".
 *
 * @property int $id
 * @property int $customer_id 顾客id
 * @property string $balance 余额
 * @property string $created_at
 * @property string $updated_at
 */
class Balance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%balance}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id'], 'required'],
            [['customer_id'], 'integer'],
            [['balance'], 'number'],
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
            'balance' => '余额',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
