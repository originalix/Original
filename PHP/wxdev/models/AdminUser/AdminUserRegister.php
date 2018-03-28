<?php

namespace app\models\AdminUser;
use app\models\AdminUser;

class AdminUserRegister extends AdminUser
{
    public $repassword;
    
    /**
     * 管理员注册子类验证规则
     *
     * @return Array
     */
    public function rules()
    {
        $parent_rules = parent::rules();
        $current_rules = [
            [['status', 'created_at', 'updated_at', 'access_token_created_at', 'allowance', 'allowance_updated_at'], 'integer'],
            [['created_at_datetime', 'updated_at_datetime', 'birth_date'], 'safe'],
            [['username', 'password'], 'string', 'max' => 50],
            [['password_hash', 'repassword'], 'string', 'max' => 80],
            [['password_reset_token', 'email', 'auth_key', 'access_token'], 'string', 'max' => 60],
            [['person', 'code'], 'string', 'max' => 100],
            
            [['access_token'], 'unique'],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required', 'message' => '用户名不能为空'],
            ['username', 'unique', 'message' => '该用户名已经被占用.'],
            ['username', 'string', 'min' => 4, 'max' => 12, 'message' => '用户名长度应在4-12字符之间'],
            ['username','match','pattern'=>'/^[a-zA-Z0-9_]+$/','message'=>'{attribute}只能由英文字母、数字、下划线组成'],


            ['email', 'required', 'message' => '邮箱不能为空'],
            ['email', 'email', 'message' => '邮箱格式不正确'],
            ['email', 'unique', 'message' => '该电子邮箱已经被占用.'],

            [['password', 'repassword'], 'required', 'message' => '{attribute}不能为空'],
            [['password', 'repassword'], 'string', 'min' => 6,'max' => 16,'message'=>'{attribute}位数为6至16位'],
            ['repassword', 'compare', 'compareAttribute' => 'password','message'=>'两次输入的密码不一致！'],
        ];
        
        return array_merge($parent_rules, $current_rules);
    }
}
