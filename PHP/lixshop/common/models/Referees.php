<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%referees}}".
 *
 * @property int $id
 * @property int $customer_id 用户id
 * @property int $referees_id 推荐人id
 * @property string $created_at
 * @property string $updated_at
 */
class Referees extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%referees}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'referees_id'], 'integer'],
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
            'customer_id' => '用户id',
            'referees_id' => '推荐人id',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
