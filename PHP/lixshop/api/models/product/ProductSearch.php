<?php

namespace api\models\product;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\mongodb\Product;

class ProductSearch extends Product
{
    public function search()
    {
        $query = static::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ],
            ],
        ]);

        return $dataProvider;
    }
}
