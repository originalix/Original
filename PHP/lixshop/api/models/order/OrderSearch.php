<?php

namespace api\models\order;

use Yii;
use api\models\order\Order;
use yii\web\HttpException;
use yii\data\ActiveDataProvider;

class OrderSearch extends Order
{
    public $type = 0;
    const ALL_ORDER = 0;
    const WAIT_PAY_ORDER = 1;
    const FINISHED_ORDER = 2;

    public function search()
    {
        $query = static::find()->where([
            'customer_id' => Yii::$app->user->identity->id,
        ]);

        $query->with(['']);

        $query->orderBy(['created_at' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    } 

    public function fields()
    {
        return [
            'id',
            'order_status',
            'items_count',
            'total_amount',
            'discount_amount',
            'discount_amount',
            'real_amount',
            'customer_id',
            'customer_group',
            'customer_name',
            'remote_ip',
            'coupon_code',
            'payment_method',
            'order_remark',
            'txn_id',
            'created_at',
            'trade_no',
            'userName',
            'province',
            'city',
            'county',
            'street',
            'postal_code',
            'tel_number',
            'express_amount',
        ];
    }
}

