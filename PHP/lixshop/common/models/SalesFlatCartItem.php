<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%sales_flat_cart_item}}".
 *
 * @property int $id
 * @property int $cart_id 购物车关联id
 * @property int $product_id 产品id
 * @property int $count 加入购物车数量
 * @property string $custom_option_key 产品的自定义属性
 * @property int $active 1代表勾选，2代表不勾选
 * @property string $created_at
 * @property string $updated_at
 */
class SalesFlatCartItem extends \yii\db\ActiveRecord
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
        return '{{%sales_flat_cart_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cart_id'], 'required'],
            [['cart_id', 'product_id', 'count', 'active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['custom_option_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cart_id' => '购物车关联id',
            'product_id' => '产品id',
            'count' => '加入购物车数量',
            'custom_option_key' => '产品的自定义属性',
            'active' => '1代表勾选，2代表不勾选',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
