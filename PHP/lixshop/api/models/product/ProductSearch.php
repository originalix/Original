<?php

namespace api\models\product;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\mongodb\Product;
use common\models\Category;

class ProductSearch extends Product
{
    public function search()
    {
        $query = static::find()
            ->where(['<>', 'stock', 0]);
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

    public function getCategory()
    {
        $query = Category::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }
}
