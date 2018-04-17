<?php

namespace backend\queues;

use yii\base\BaseObject;
use common\models\Product;
use common\models\CustomOptionStock;
use common\models\ProductImage;
use common\models\ProductFlatStock;
use common\models\ProductCategory;
use common\models\Category;
use common\models\mongodb\Product as MongoProduct;

class ProductDataJob extends BaseObject implements \yii\queue\JobInterface
{
    public $product_id;

    public function excute($queue)
    {
        $mongoProduct = new MongoProduct();
        $imageArr = [];
        $categoryArr = [];
        $custom_option_arr = [];

        $product = Product::findOne($product_id);
        // $product->image;
        foreach($product->image as $imgModel) {
            // Yii::getAlias('@baseurl').'/backend/web'. $imageModel->path,
            $path = Yii::getAlias('@baseurl').'/backend/web'. $imgModel->path;
            array_push($imageArr, $path);
        }

        // $product->flatStock;

        // $product->category;
        foreach($product->category as $category) {
           array_push($categoryArr, $category->category);
        }
        // $product->customOptionStock;
        foreach($product->customOptionStock as $customOption) {
            array_push($custom_option_arr, $customOption);
        }
    }
}
