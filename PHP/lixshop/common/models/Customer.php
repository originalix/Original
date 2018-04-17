<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property int $id
 * @property string $wechat_openid 微信open_id
 * @property string $mobile 手机号码
 * @property int $group 客户类别 1、普通客户 2、学生
 * @property string $created_at
 * @property string $updated_at
 * @property string $access_token 登录令牌
 * @property int $favorite_product_count 收藏个数
 * @property string $access_token_created_at
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group', 'favorite_product_count'], 'integer'],
            [['created_at', 'updated_at', 'access_token_created_at'], 'safe'],
            [['wechat_openid', 'access_token'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'wechat_openid' => '微信open_id',
            'mobile' => '手机号码',
            'group' => '客户类别 1、普通客户 2、学生',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'access_token' => '登录令牌',
            'favorite_product_count' => '收藏个数',
            'access_token_created_at' => 'Access Token Created At',
        ];
    }
}
