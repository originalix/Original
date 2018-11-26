<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_flat_stock}}".
 *
 * @property int $id
 * @property string $product_id 产品id
 * @property int $stock 库存数量
 */
class ProductFlatStock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_flat_stock}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stock', 'product_id'], 'integer'],
            [['stock', 'product_id'], 'required'],
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
            'stock' => '库存数量',
        ];
    }
}
