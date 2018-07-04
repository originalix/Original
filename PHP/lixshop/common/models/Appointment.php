<?php

namespace common\models;

use Yii;
use common\models\Attachment;

/**
 * This is the model class for table "{{%appointment}}".
 *
 * @property int $id
 * @property string $platform 购买平台
 * @property int $enter_type 输入方式，1-手动输入，2-上传截图
 * @property string $code 手动输入的团购券
 * @property int $clothes_count 衣服数量
 * @property string $userName 收件人姓名
 * @property string $province 省
 * @property string $city 市
 * @property string $county 区
 * @property string $street 详细地址
 * @property string $postal_code 邮编
 * @property string $tel_number 电话号码
 * @property string $created_at
 * @property string $updated_at
 */
class Appointment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%appointment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enter_type', 'clothes_count'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['platform', 'code', 'userName', 'county', 'street', 'postal_code', 'tel_number'], 'string', 'max' => 255],
            [['province', 'city'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'platform' => '购买平台',
            'enter_type' => '输入方式，1-手动输入，2-上传截图',
            'code' => '手动输入的团购券',
            'clothes_count' => '衣服数量',
            'userName' => '收件人姓名',
            'province' => '省',
            'city' => '市',
            'county' => '区',
            'street' => '详细地址',
            'postal_code' => '邮编',
            'tel_number' => '电话号码',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function fields()
    {
        return [
            'id',
            'platform',
            'enter_type',
            'code',
            'images' => function ($model) {
                if ($model->enter_type === 2) {
                    return $model->images;
                } else {
                    return null;
                }
            },
            'clothes_count',
            'userName',
            'province',
            'city',
            'county',
            'street',
            'postal_code',
            'tel_number',
            'created_at',
            'updated_at',
        ];
    }

    public function getImages()
    {
        $where['type'] = 'appointment';
        return $this->hasMany(Attachment::className(), ['type_id' => 'id'])->where($where);
    }
}
