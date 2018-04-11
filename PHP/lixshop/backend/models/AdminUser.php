<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%admin_user}}".
 *
 * @property int $id
 * @property string $username 管理员用户名
 * @property string $password_hash 密码hash
 * @property string $password_reset_token 重置密码令牌
 * @property string $person 姓名
 * @property string $mobile 手机号
 * @property string $auth_key 加密串
 * @property int $status 账号状态
 * @property string $access_token 登录令牌
 * @property string $created_at
 * @property string $updated_at
 */
class AdminUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'mobile'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username'], 'string', 'max' => 50],
            [['password_hash', 'password_reset_token', 'auth_key', 'access_token'], 'string', 'max' => 255],
            [['person'], 'string', 'max' => 10],
            [['mobile'], 'string', 'max' => 11],
            [['username'], 'unique'],
            [['access_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '管理员用户名',
            'password_hash' => '密码hash',
            'password_reset_token' => '重置密码令牌',
            'person' => '姓名',
            'mobile' => '手机号',
            'auth_key' => '加密串',
            'status' => '账号状态',
            'access_token' => '登录令牌',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
