<?php

namespace api\models\product;

use Yii;
use yii\data\ActiveDataProvider;
use common\models\Product;
use common\models\Category;
use common\models\ProductCategory;

class ProductInfo extends Product
{
    public function search($id)
    {
        $query = static::findOne($id);
        return $query;
    }

    public function fields()
    {
        return [
            'id',
            'name',
            'sku',
            'score',
            'status',
            'min_sales_qty',
            'is_in_stock',
            'visibility',
            'url_key',
            'image' => function ($model) {
                $arr = [];
                foreach($model->image as $imageModel) {
                    $url = Yii::getAlias('@baseurl').'/backend/web'. $imageModel->path;
                    array_push($arr, $url);
                }
                return $arr;
            },
            'category',
            'customOptionStock',
            'flatStock',
            // 'stock' => '库存数量',
            'price',
            'cost_price',
            'final_price',
            'meta_title',
            'meta_keywords',
            'meta_description',
            'package_number',
            'created_user_id',
            'reviw_rate_star_average',
            'review_count',
            'favorite_count',
        ];
    }
}
