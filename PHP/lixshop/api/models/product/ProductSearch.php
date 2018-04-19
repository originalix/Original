<?php

namespace api\models\product;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\mongodb\Product;
use common\models\Category;
use common\models\ProductCategory;

class ProductSearch extends Product
{
    public function search()
    {
        $query = static::find()
            ->where(['<>', 'status', 2]);
            // ->andWhere(['category' => [4]]);
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

    public function searchByCategoryId($id)
    {
        $category_models = ProductCategory::find()
            ->where(['category_id' => $id])
            ->all();

        $product_arr = [];
        foreach ($category_models as $model) {
            array_push($product_arr, $model->product_id);
        }

        $query = static::find()
        ->where(['<>', 'status', 2])
        ->andWhere(['product_id' => $product_arr]);

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

    public function fields()
    {
        return [
            // '_id',
            'id' => 'product_id',
            'name', //产品名称
            'spu', 
            'sku',
            
            'score',   // 产品的评分
            'status',  // 产品的状态，1代表激活，2代表下架
            'min_sales_qty', // 产品的最小销售个数
            'is_in_stock', // 产品 的库存状态，1代表有库存，2代表无库存
            'visibility', // 是否可见
            // 'url_key', // url地址
            'stock', //库存数量
            
            'category', // 产品的分类id。可以多个
            'price', // 产品的销售价格
            // 'cost_price', // 成本价格
            // 'final_price',   // 算出来的最终价格。这个通过脚本赋值。
            'meta_title',
            'meta_keywords',
            'meta_description',
            'image',
            // 'description',
            // 'short_description',
            'custom_option',    // 产品 custom option部分，也就是淘宝模式的颜色尺码这类属性
            'package_number',  // 打包销售个数，譬如，值为5，则加入购物车的个数都是5的倍数。
            'created_at',
            // 'updated_at',
            // 'created_user_id',
            // 'attr_group',
            'reviw_rate_star_average',       //评论平均评分
            'review_count',                  //评论总数            
            'reviw_rate_star_info',          // 评星详细，各个评星的个数
            'favorite_count',                // 产品被收藏的次数。
        ];
    }
}
