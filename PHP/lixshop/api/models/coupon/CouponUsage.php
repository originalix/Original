<?php

namespace api\models\coupon;

use Yii;
use common\models\CouponUsage as CommonCouponUsage;

class CouponUsage extends CommonCouponUsage
{

    public function fields()
    {
        return [
            'id',
            'coupon',
            'coupon_id',
            'is_used',
            'created_at'
        ];
    }
}
