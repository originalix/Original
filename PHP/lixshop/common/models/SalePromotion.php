<?php

namespace common\models;

use Yii;

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
}
