<?php

namespace api\models\customer;

use yii\base\Model;
use common\models\Customer;

class AddCustomer extends Model
{
    public $openId;
    public $mobile;

    public function rules()
    {
        return [
            ['openId', 'required', 'message' => '未获取到微信身份信息，请重新进入小程序'],
            ['mobile', 'unique', 'targetClass' => '\common\models\Customer', 'message' => '手机号已经注册。'],
            ['mobile', 'filter', 'filter' => 'trim'],
            [['mobile'],'match','pattern'=>'/^[1][3578][0-9]{9}$/'],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $customer = new Customer();
        $customer->wechat_openid = $this->openId;
        $customer->mobile = $this->mobile;
        $customer->group = 1;
        $customer->generateAccessToken();
    
        return $customer->save() ? $customer : null;
    }
}
