<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_image}}".
 *
 * @property int $id
 * @property int $product_id 产品id
 * @property string $path 存储路径
 * @property string $filename 文件名
 */
class ProductImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['path', 'filename'], 'string', 'max' => 255],
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
            'path' => '存储路径',
            'filename' => '文件名',
        ];
    }
}
