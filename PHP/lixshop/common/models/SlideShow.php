<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%slide_show}}".
 *
 * @property int $id
 * @property string $title 轮播图标题
 * @property string $path 存储路径
 * @property string $filename 文件名
 * @property int $is_usage 是否使用
 * @property string $created_at
 * @property string $updated_at
 */
class SlideShow extends \yii\db\ActiveRecord
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
        return '{{%slide_show}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'path', 'filename'], 'string', 'max' => 255],
            [['is_usage'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '轮播图标题',
            'path' => '存储路径',
            'filename' => '文件名',
            'is_usage' => '是否使用',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function fields()
    {
        return [
            'id',
            'title',
            'url' => function () {
                return Yii::getAlias('@baseurl').'/backend/web'. $this->path;
            }
        ];
    }
}
