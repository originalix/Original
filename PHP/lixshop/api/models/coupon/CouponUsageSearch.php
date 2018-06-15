<?php

namespace api\models\coupon;

use Yii;
use api\models\coupon\CouponUsage;
use yii\web\HttpException;
use yii\data\ActiveDataProvider;
use api\models\coupon\Coupon;
// use common\models\Coupon;

class CouponUsageSearch extends CouponUsage
{
    const COUPON_NOT_USED = 1;
    const COUPON_IS_USED = 2;
    const COUPON_EXPIRED = 3;

    public $type;

    public function rules()
    {
        return [
            [['coupon_id', 'customer_id'], 'required'],
            [['coupon_id', 'customer_id', 'is_used'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function search()
    {
        // 默认type 未使用、未过期
        $query = static::find()
            ->where([
                'customer_id' => Yii::$app->user->identity->id,
                'is_used' => 1
            ])->joinWith([
                'coupon' => function ($query) {
                    // 不过期的where条件 
                    $query->AndWhere('DATEDIFF(expiration_date, NOW()) >= 1');
                },
            ]);

        // type为2 使用过的优惠券
        if ($this->type === static::COUPON_IS_USED) {
            $query = static::find()
                ->where([
                    'customer_id' => Yii::$qpp->user->identity->id,
                    'is_used' => 2
                ]);
        } else if ($this->type === static::COUPON_EXPIRED) {
            // type为3 过期的并且未使用过的优惠券 
            $query = static::find()
                ->where([
                    'customer_id' => Yii::$app->user->identity->id,
                    'is_used' => 1
                ])->joinWith([
                    'coupon' => function ($query) {
                        // 已过期的where条件 
                        $query->AndWhere('DATEDIFF(expiration_date, NOW()) < 1');
                    },
                ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}

