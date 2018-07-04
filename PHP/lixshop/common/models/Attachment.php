<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%attachment}}".
 *
 * @property int $id
 * @property string $type 图片使用类型
 * @property int $type_id 关联模型id
 * @property string $path 图片存储路径
 * @property string $url 展示url
 * @property int $width 图片的宽
 * @property int $height 高
 * @property string $created_at
 * @property string $updated_at
 */
class Attachment extends \yii\db\ActiveRecord
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
        return '{{%attachment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'width', 'height'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'path', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '图片使用类型',
            'type_id' => '关联模型id',
            'path' => '图片存储路径',
            'url' => '展示url',
            'width' => '图片的宽',
            'height' => '高',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
