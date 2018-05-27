<?php

namespace api\modules\v1\models;

use Yii;
use common\models\ProductCategory;
use yii\data\ActiveDataProvider;

class CategoryListSearch extends ProductCategory
{
    public function search($id)
    {
        // $query = static::find()->where([
            // 'category_id' => $id 
        // ]); 
        // $query->with('product');

        // $dataProvider = new ActiveDataProvider([
            // 'query' => $query,
        // ]);

        // return $dataProvider;
        // $a = static::find()->where([
            // 'product_id' => $id
        // ])->one();
        $a = static::findOne($id);
        return $a->product;
    }
}

