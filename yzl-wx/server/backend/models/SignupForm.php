<?php

namespace backend\models;

use yii\base\Model;
use backend\models\AdminUser;

class SignupForm extends Model
{
    public $username;
    public $mobile;
    public $password;
    public $re_password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['mobile', 'filter', 'filter' => 'trim'],
            ['mobile', 'required', 'message' => '手机号码不能为空'],
             //targetClass 不会自己调用Ajax验证，提交表单后才会触发
            ['mobile', 'unique', 'targetClass' => '\backend\models\AdminUser', 'message' => '手机号已经注册。'],
            [['mobile'],'match','pattern'=>'/^[1][3578][0-9]{9}$/'],

            ['username', 'trim'],
            ['username', 'required', 'message' => '用户名不能为空'],
            ['username', 'unique', 'targetClass' => '\backend\models\AdminUser', 'message' => '用户名已经被使用'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required', 'message' => '密码不能为空'],
            ['re_password','required', 'message' => '确认密码不能为空'],
            ['re_password','compare','compareAttribute'=>'password','message'=>'两次密码输入不一致。'],
            ['password', 'string', 'min' => 6],
            ['re_password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        print_r('sign up!');
        if (!$this->validate()) {
            print_r('null!');
            return null;
        }
        
        $user = new AdminUser();
        $user->username = $this->username;
        $user->mobile = $this->mobile;
        print_r($user->mobile);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
