<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_user".
 *
 * @property int $id
 * @property string $username 用户名
 * @property string $password_hash 密码
 * @property string $password_reset_token 密码token
 * @property string $email 邮箱
 * @property string $person 用户姓名
 * @property string $code
 * @property string $auth_key
 * @property int $status 状态
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property string $password 密码
 * @property string $access_token
 * @property int $access_token_created_at access token 的创建时间，格式为Int类型的时间戳
 * @property int $allowance
 * @property int $allowance_updated_at
 * @property string $created_at_datetime
 * @property string $updated_at_datetime
 * @property string $birth_date 出生日期
 */
class AdminUser extends \yii\db\ActiveRecord
{
    public $confirm_password;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at', 'access_token_created_at', 'allowance', 'allowance_updated_at'], 'integer'],
            [['created_at_datetime', 'updated_at_datetime', 'birth_date'], 'safe'],
            [['username', 'password'], 'string', 'max' => 50],
            [['password_hash', 'confirm_password'], 'string', 'max' => 80],
            [['password_reset_token', 'email', 'auth_key', 'access_token'], 'string', 'max' => 60],
            [['person', 'code'], 'string', 'max' => 100],
            
            [['access_token'], 'unique'],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'message' => '该用户名已经被占用.'],
            ['username', 'string', 'min' => 4, 'max' => 12],
            ['username','match','pattern'=>'/^[a-zA-Z0-9_]+$/','message'=>'{attribute}只能由英文字母、数字、下划线组成'],


            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'message' => '该电子邮箱已经被占用.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6,'max' => 16,'message'=>'{attribute}位数为6至16位'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password_hash' => '密码',
            'password_reset_token' => '密码token',
            'confirm_password' => '再次输入密码', 
            'email' => '邮箱',
            'person' => '用户姓名',
            'code' => 'Code',
            'auth_key' => 'Auth Key',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'password' => '密码',
            'access_token' => 'Access Token',
            'access_token_created_at' => 'access token 的创建时间，格式为Int类型的时间戳',
            'allowance' => 'Allowance',
            'allowance_updated_at' => 'Allowance Updated At',
            'created_at_datetime' => 'Created At Datetime',
            'updated_at_datetime' => 'Updated At Datetime',
            'birth_date' => '出生日期',
        ];
    }
}
