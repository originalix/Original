<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\AdminUser;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;

    public function rules()
    {
        return [
            // username and password are both required
            ['username', 'required', 'message' => '用户名不能为空'],
            ['password', 'required', 'message' => '密码不能为空'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || $user->validatePassword($this->password)) {
                $this->addError($attribute, '错误的用户名或密码');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = AdminUser::findByUsername($this->username);
        }

        return $this->_user;
    }
}
