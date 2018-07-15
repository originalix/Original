<?php

namespace common\models;

use Yii;
use common\models\Product;

/**
 * This is the model class for table "{{%sale_promotion}}".
 *
 * @property int $id
 * @property int $product_id 产品id
 * @property int $sale_count 已经团购数量
 * @property string $created_at
 * @property string $updated_at
 * @property integer $need_vip
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
            [['product_id', 'sale_count', 'need_vip'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function fields()
    {
        return [
            'id',
            'product_id',
            'product',
            'sale_count',
            'need_vip',
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
            'sale_count' => '已经团购数量',
            'need_vip' => '是否是会员专享',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
