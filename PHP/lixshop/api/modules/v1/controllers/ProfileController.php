<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\models\CouponUsage;
use common\models\Balance;
use common\models\Customer;
use yii\web\HttpException;

class ProfileController extends BaseController
{
    public function actionIndex()
    {
        // 手机号
        $user = Yii::$app->user->identity;
        // $mobile = $user->mobile;
        // $mobile = $this->setSecretMobile($mobile);
        // $user = Customer::findOne(Yii::$app->user->identity->id);

        // 优惠券
        $coupon = CouponUsage::find()
            ->where(['customer_id' => $user->id])
            ->andWhere(['is_used' => 1])
            ->all();

        $couponCount = count($coupon);

        // 余额
        // $balance = 0.00;
        // $balanceModel = Balance::find()
            // ->where(['customer_id' => $user->id])
            // ->one();
        // if (!is_null($balanceModel)) {
            // $balance = $balanceModel->balance;
        // }

        // 积分

        return [
            'user' => $user,
            'coupon' => $couponCount,
            // 'mobile' => $mobile,
            // 'balance' => $balance,
        ];
    }

    protected function setSecretMobile($mobile)
    {
        return preg_replace('/(\d{3})\d{4}(\d{4})/', '$1****$2', $mobile);
    }

    public function actionIp()
    {
        return Yii::$app->request->userIP;
    }

    /**
     *  更新用户姓名手机号接口
     */
    public function actionInfo()
    {
        $mobile = Yii::$app->request->post('mobile');
        $name = Yii::$app->request->post('name');
        if (is_null($mobile)) {
            throw new HttpException(421, '请填写您的手机号');
            if (is_null($name)) {
                throw new HttpException(421, '请填写您的姓名');
            }
        }

        if(! preg_match("/^1[34578]\d{9}$/", $mobile)){
            throw new HttpException(419, '请填写正确合法的手机号');
        }

        if (! preg_match("/^([\x{4e00}-\x{9fa5}]+)$/u", $name) && ! preg_match("/^[a-z]+$/i", $name)) {
            throw new HttpException(419, '涉及资金安全，请使用您的真实姓名');
        }

        $customer = Customer::findOne(Yii::$app->user->identity->id);
        $customer->mobile = $mobile;
        $customer->name = $name;

        return $customer->save();
    }
}
