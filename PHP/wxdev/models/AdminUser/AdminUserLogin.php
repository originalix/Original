<?php

namespace app\models\AdminUser;
use app\models\AdminUser;

class AdminUserLogin extends AdminUser
{
    public $password;

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
        ];

        return array_merge($parent_rules, $current_rules);
    }

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

}
