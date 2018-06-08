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

        if ($this->type == static::WAIT_PAY_ORDER) {
            $query = static::find()->where([
                'customer_id' => Yii::$app->user->identity->id,
                'order_status' => static::WAIT_PAY_ORDER,
            ]);
        } else if ($this->type == static::FINISHED_ORDER) {
            $query = static::find()->where([
                'customer_id' => Yii::$app->user->identity->id,
            ])
            ->andWhere(['<>', 'order_status', static::WAIT_PAY_ORDER]);
        } 

        $query->with(['items']);

        $query->orderBy(['created_at' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    } 

    public function detail($id)
    {

    }

    public function fields()
    {
        return [
            'id',
            'order_status',
            'items_count',
            'items',
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

