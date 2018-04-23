<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%sales_flat_order_item}}".
 *
 * @property int $id
 * @property int $order_id 关联的订单id
 * @property int $customer_id 顾客id
 * @property int $product_id 产品id
 * @property string $custom_option_key 产品自定义的属性key
 * @property string $name 产品名称
 * @property string $image 封面图片
 * @property int $count 购买数量
 * @property string $price 产品单价
 * @property string $row_total 一个产品价格*个数
 * @property string $redirect_url 封面图片
 * @property string $created_at
 * @property string $updated_at
 */
class SalesFlatOrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sales_flat_order_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'customer_id', 'product_id', 'count'], 'integer'],
            [['custom_option_key'], 'required'],
            [['price', 'row_total'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['custom_option_key', 'name', 'image', 'redirect_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => '关联的订单id',
            'customer_id' => '顾客id',
            'product_id' => '产品id',
            'custom_option_key' => '产品自定义的属性key',
            'name' => '产品名称',
            'image' => '封面图片',
            'count' => '购买数量',
            'price' => '产品单价',
            'row_total' => '一个产品价格*个数',
            'redirect_url' => '跳转地址',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
