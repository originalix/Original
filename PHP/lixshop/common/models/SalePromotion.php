<?php

namespace common\models;

use Yii;
use common\models\Product;

/**
 * This is the model class for table "{{%sale_promotion}}".
 *
 * @property int $id
 * @property int $product_id 产品id
 */
class SalePromotion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sale_promotion}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
        ];
    }

    public function fields()
    {
        return [
            'id',
            'product_id',
            'product',
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
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
