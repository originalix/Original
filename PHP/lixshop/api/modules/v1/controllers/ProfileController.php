<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;

class ProfileController extends BaseController
{
    public function actionIndex()
    {
        // 手机号
        $mobile = $this->setSecretMobile('13188877109');
        return $mobile;
        // 优惠券

        // 余额

        // 积分

    }

    protected function setSecretMobile($mobile)
    {
        return preg_replace('/(\d{3})\d{4}(\d{4})/', '$1****$2', $mobile);
    }
}
