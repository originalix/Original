<?php

namespace api\models\coupon;

use Yii;
use api\models\CouponUsage as CommonCouponUsage;
use yii\web\HttpException;
use yii\data\ActiveDataProvider;

class CouponUsageSearch extends CommonCouponUsage
{
    const COUPON_NOT_USED = 1;
    const COUPON_IS_USED = 2;
    const COUPON_EXPIRED = 3;

    public $type;

    public function search()
    {
        // $query = static::find()
            // ->where([
                // 'customer_id' => Yii::$app->user->identity->id,
                // 'is_used' => 1
            // ])->JoinWith(['coupon' => function ($query) {
                // $query->where(['expiration_date' => ])
            // }])->all();
        //
        $query = static::find()
            ->where([
                'customer_id' => Yii::$app->user->identity->id,
                'is_used' => 1
            ])->all();
        $query->with('coupon');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}

