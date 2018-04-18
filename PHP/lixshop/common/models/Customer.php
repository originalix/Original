<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;

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
class Customer extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $username;
    
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


    public static function loginByAccessToken($accessToken, $type) {
        return static::findIdentityByAccessToken($accessToken, $type);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->access_token;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAccessToken()
    {
        $this->access_token = Yii::$app->security->generateRandomString();
    }

}
