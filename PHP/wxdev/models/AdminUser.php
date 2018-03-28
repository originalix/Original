<?php
/*
 * @Author: Lix 
 * @Date: 2018-03-29 07:48:44 
 * @Last Modified by: Lix
 * @Last Modified time: 2018-03-29 07:58:33
 */

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\filters\RateLimitInterface;

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
class AdminUser extends ActiveRecord implements IdentityInterface, RateLimitInterface
{
    const STATUS_DELETED = 10;
    const STATUS_ACTIVE = 1;

    # 速度控制  6秒内访问3次，注意，数组的第一个不要设置1，设置1会出问题，一定要
	#大于2，譬如下面  6秒内只能访问三次
	# 文档标注：返回允许的请求的最大数目及时间，例如，[100, 600] 表示在600秒内最多100次的API调用。
    public function getRateLimit($request, $action)
    {
        return [6000000, 6];
    }

    # 文档标注： 返回剩余的允许的请求和相应的UNIX时间戳数 当最后一次速率限制检查时。
    public function loadAllowance($request, $action)
    {
        return [$this->allowance, $this->allowance_update_at];
    }

    # allowance 对应user 表的allowance字段  int类型
	# allowance_updated_at 对应user allowance_updated_at  int类型
	# 文档标注：保存允许剩余的请求数和当前的UNIX时间戳。
    public function saveAllowance($request, $action, $allowance, $timestamp)
    {
        $this->allowance = $allowance;
        $this->allowance_update_at = $timestamp;
        $this->save();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
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

    /**
     * 数据库表名
     *
     * @return String
     */
    public static function tableName()
    {
        return 'admin_user';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    
    /**
     * 通过用户ID，找到identity
     *
     * @param [integer] $id 用户id
     * @return self
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * 通过access_token 找到identity
     *
     * @param [String] $token
     * @param [type] $type
     * @return self
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * 生成access_token
     *
     * @return String
     */
    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString();
    }
}
