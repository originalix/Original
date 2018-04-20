<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%favorite}}".
 *
 * @property int $id
 * @property string $product_id 产品id
 * @property int $customer_id 顾客id
 * @property string $created_at
 * @property string $updated_at
 */
class Favorite extends \yii\db\ActiveRecord
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
        return '{{%favorite}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['product_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => '产品id',
            'customer_id' => '顾客id',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
