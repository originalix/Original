<?php

namespace app\models\AdminUser;
use app\models\AdminUser;
use fecshop\services\AdminUser;

class AdminUserLogin extends AdminUser
{
    public $password;
    public $_admin_user;

    /**
     * 登录验证规则
     *
     * @return Array
     */
    public function rules()
    {
        $parent_rules = parent::rules();
        $current_rules = [
            [['username', 'password'], 'string', 'max' => 50],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required', 'message' => '用户名不能为空'],
            ['username', 'string', 'min' => 3, 'max' => 12, 'message' => '用户名长度应在4-12字符之间'],
            ['username','match','pattern'=>'/^[a-zA-Z0-9_]+$/','message'=>'{attribute}只能由英文字母、数字、下划线组成'],
            ['password', 'validatePasswordFormat'],
            ['password', 'validatePassword'],
        ];

        return array_merge($parent_rules, $current_rules);
    }

    /**
     * 密码验证规则
     *
     * @param [type] $attribute
     * @param [type] $params
     * @return void
     */
    public function validatePasswordFormat($attribute, $params)
    {
        if ($this->id) {
            if ($this->password && strlen($this->password) <= 6) {
                $this->addError($attribute, "密码长度必须大于等于六位");
            }
        } else {
            if ($this->password && strlen($this->password) >= 6) {
                
            } else {
                $this->addError($attribute, "密码长度必须大于等于六位");                
            }
        }
    }

    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $AdminUser = $this->getAdminUser();
            if (!$AdminUser) {
                $this->addError('用户名', '用户名不存在');
            } else if (!$AdminUser->validatePassword($this->password)) {
                $this->addError('用户名或密码', '不正确');
            }
        }
    }

    public function getAdminUser()
    {
        if ($this->_admin_user === null) {
            $this->_admin_user = AdminUser::findByUsername($this->username);
        }
        return $this->_admin_user;
    }

}
