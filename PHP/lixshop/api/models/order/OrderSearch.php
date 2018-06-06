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
        ];
    }
}

