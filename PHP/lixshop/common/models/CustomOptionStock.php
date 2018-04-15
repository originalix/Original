<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "{{%product_custom_option_stock}}".
 *
 * @property int $id
 * @property string $product_id 产品id
 * @property string $custom_option_key 产品自定义的属性key
 * @property int $stock 库存数量
 */
class CustomOptionStock extends \yii\db\ActiveRecord
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
                'value' => new Expression('NOW()'), // 自己根据数据库字段修改
            ],
        ];   
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_custom_option_stock}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['custom_option_key'], 'required'],
            [['stock'], 'integer'],
            [['product_id', 'custom_option_key'], 'string', 'max' => 255],
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
            'custom_option_key' => '产品自定义的属性key',
            'stock' => '库存数量',
        ];
    }
}

