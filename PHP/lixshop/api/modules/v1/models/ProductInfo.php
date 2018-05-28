<?php

namespace api\modules\v1\models;

use Yii;
use common\models\Product;

class ProductInfo extends Product
{
    public function fields()
    {
        return [
            'id',
            'name',
            'spu',
            'sku',
            'score',
            'status',
            'min_sales_qty',
            'is_in_stock',
            'visibility',
            'url_key',
            'image' => function () {
                
            },
            'category',
            'customOptionStock',
            // 'stock' => '库存数量',
            'price',
            'cost_price',
            'final_price',
            'meta_title',
            'meta_keywords',
            'meta_description' ,
            'package_number',
            'created_user_id',
            'reviw_rate_star_average',
            'review_count',
            'favorite_count',
            'created_at',
            'updated_at',
        ];
    }
}
