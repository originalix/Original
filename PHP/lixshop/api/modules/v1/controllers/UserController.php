<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\models\Customer;

class UserController extends BaseController
{
    /**
     * 获取顾客个人信息接口
     *
     * @return JSON userinfo
     */
    public function actionMe()
    {
        return Customer::findOne(Yii::$app->user->identity->id);
    }
}
