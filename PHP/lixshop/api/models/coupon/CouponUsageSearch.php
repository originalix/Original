<?php

namespace api\models\coupon;

use Yii;
use api\models\CouponUsage as CommonCouponUsage;
use yii\web\HttpException;

class CouponUsageSearch extends CommonCouponUsage
{
    const COUPON_NOT_USED = 1;
    const COUPON_IS_USED = 2;
    const COUPON_EXPIRED = 3;

    public $type;

    public function search()
    {
        $query = static::find()
            ->where([
                'customer_id' => Yii::$app->user->identity->id,
                'is_used' => 1
            ])->all();
    }
}

