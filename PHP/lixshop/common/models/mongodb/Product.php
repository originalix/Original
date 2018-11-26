<?php

namespace common\models\mongodb;

use yii\mongodb\ActiveRecord;

class Product extends ActiveRecord
{
    public static $_customProductAttrs;
    
    public static function collectionName()
    {
        return 'product';
    }

    public function attributes()
    {
        $origin = [
            '_id',
            'product_id',
            'name', //产品名称
            'spu', 
            'sku',
            
            'score',   // 产品的评分
            'status',  // 产品的状态，1代表激活，2代表下架
            'min_sales_qty', // 产品的最小销售个数
            'is_in_stock', // 产品 的库存状态，1代表有库存，2代表无库存
            'visibility', // 是否可见
            'url_key', // url地址
            'stock', //库存数量
            
            'category', // 产品的分类id。可以多个
            'price', // 产品的销售价格
            'cost_price', // 成本价格
            'final_price',   // 算出来的最终价格。这个通过脚本赋值。
            'meta_title',
            'meta_keywords',
            'meta_description',
            'image',
            'description',
            'short_description',
            'custom_option',    // 产品 custom option部分，也就是淘宝模式的颜色尺码这类属性
            'package_number',  // 打包销售个数，譬如，值为5，则加入购物车的个数都是5的倍数。
            'created_at',
            'updated_at',
            'created_user_id',
            'attr_group',
            'reviw_rate_star_average',       //评论平均评分
            'review_count',                  //评论总数            
            'reviw_rate_star_info',          // 评星详细，各个评星的个数
            'favorite_count',                // 产品被收藏的次数。
        ];

        if (is_array(self::$_customProductAttrs) && !empty(self::$_customProductAttrs)) {
            $origin = array_merge($origin, self::$_customProductAttrs);
        }

        return $origin;
    }
}
