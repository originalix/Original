<?php

namespace api\models\coupon;

use Yii;
use yii\base\Model;
use api\models\coupon\Coupon;
use api\models\coupon\CouponUsage;
use yii\web\HttpException;

class CouponLogic extends Model
{
    public function exchange($code)
    {
        // 检查是否有该优惠券
        $coupon = Coupon::find()
            ->where(['coupon_code' => $code])
            ->one();
        
        if (is_null($coupon)) {
            throw new HttpException(420, '该优惠券码不存在，请检查后重新输入');
        }

        // 检查该券是否过期
        $now_time = date("y-m-d h:i:s");
        $expiration_time = $coupon->expiration_date;

        if (strtotime($now_time) > strtotime($expiration_time)) {
            throw new HttpException(421, '该优惠券码已过期');
        }
        // 检查本来是否有该券

        // 如果超过使用次数 那么失败

       // 否则 领券成功 
    }
}
