<?php

namespace api\modules\v1\models;

use Yii;
use common\models\ProductCategory;
use api\models\product\ProductInfo;
use yii\data\ActiveDataProvider;

class CategoryListSearch extends ProductCategory
{
    public function fields()
    {
        return [
            'product'
        ];
    }

    public function search($id)
    {
        $query = static::find()->where([
            'category_id' => $id 
        ]);
        $query->with('product');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 200,
            ],
        ]);

        return $dataProvider;
        // $a = static::findOne(18);
        // return $a->product;
    }

    public function getProduct()
    {
        return $this->hasOne(ProductInfo::className(), ['id' => 'product_id']);
    }

}

