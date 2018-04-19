<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%customer_address}}".
 *
 * @property int $id
 * @property int $customer_id 顾客id
 * @property string $name 姓名
 * @property string $telephone 电话
 * @property string $province 省份
 * @property string $city 城市
 * @property string $district 区
 * @property string $street 街道地址
 * @property int $is_default 是否为默认地址
 * @property string $created_at
 * @property string $updated_at
 */
class CustomerAddress extends \yii\db\ActiveRecord
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
        return '{{%customer_address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'name', 'telephone', 'province', 'city', 'district', 'street'], 'required'],
            [['customer_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'province'], 'string', 'max' => 100],
            [['telephone'], 'string', 'max' => 11],
            [['city', 'district', 'street'], 'string', 'max' => 255],
            [['is_default'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => '顾客id',
            'name' => '姓名',
            'telephone' => '电话',
            'province' => '省份',
            'city' => '城市',
            'district' => '城区',
            'street' => '街道地址',
            'is_default' => '是否为默认地址',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
