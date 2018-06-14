<?php

namespace api\models\coupon;

use Yii;
use api\models\coupon\CouponUsage as CommonCouponUsage;
use yii\web\HttpException;
use yii\data\ActiveDataProvider;
// use api\models\coupon\Coupon;
use common\models\Coupon;

class CouponUsageSearch extends CommonCouponUsage
{
    const COUPON_NOT_USED = 1;
    const COUPON_IS_USED = 2;
    const COUPON_EXPIRED = 3;

    public $type;

    public function search()
    {
        // $query = static::find()
        //     ->where([
        //         'customer_id' => Yii::$app->user->identity->id,
        //         'is_used' => 1
        //     ])->joinWith([
        //         'coupon' => function ($query) {
        //             $query->AndWhere('DATEDIFF(DAY, expiration_date, getdate()) <= 15');
        //         },
        //     ]);
        $query = Coupon::find()
            ->where('DATEDIFF(expiration_date, NOW()) > 1');
        
        //DATEDIFF(DAY,dateadd(m,AgentDate,UpdateTime),getdate())<=15
        // start
        // $query = static::find()
            // ->where([
                // 'customer_id' => Yii::$app->user->identity->id,
                // 'is_used' => 1
            // ]);
        // $query->with('coupon');
        // end

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}

