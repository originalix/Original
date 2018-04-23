<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\models\CouponUsage;
use common\models\Balance;

class ProfileController extends BaseController
{
    public function actionIndex()
    {
        // 手机号
        $user = Yii::$app->user->identity;
        $mobile = $user->mobile;
        $mobile = $this->setSecretMobile($mobile);

        // 优惠券
        $coupon = CouponUsage::find()
            ->where(['customer_id' => $user->id])
            ->andWhere(['times_used' => 0])
            ->all();

        $couponCount = count($coupon);

        // 余额
        $balance = 0.00;
        $balanceModel = Balance::find()
            ->where(['customer_id' => $user->id])
            ->one();
        if (! is_null($balanceModel)) {
            $balance = $balanceModel->balance;
        }

        // 积分
        
        return [
            'user' => $user,
            'coupon' => $couponCount,
            'mobile' => $mobile,
            'balance' => $balance,
        ];
    }

    protected function setSecretMobile($mobile)
    {
        return preg_replace('/(\d{3})\d{4}(\d{4})/', '$1****$2', $mobile);
    }
}
