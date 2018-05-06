<?php

namespace backend\queues;

use Yii;
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
    
    public function execute($queue)
    {
        print_r(['msg' => '重新开始 调用消息队列']);
        $mongoProduct = MongoProduct::find()
        ->where(['product_id' => intval($this->product_id)])
        ->one();

        print_r(['msg' => $this->product_id]);

        if (is_null($mongoProduct)) {
            $mongoProduct = new MongoProduct();
            print_r(['msg' => '新建product']);
        }

        $imageArr = [];
        $categoryArr = [];
        $custom_option_arr = [];

        $product = Product::findOne($this->product_id);
        // $product->image;
        foreach($product->image as $imgModel) {
            // Yii::getAlias('@baseurl').'/backend/web'. $imageModel->path,
            $path = Yii::getAlias('@baseurl').'/backend/web'. $imgModel->path;
            array_push($imageArr, $path);
        }
        // print_r($imageArr);
        // echo "</br>";

        // $product->flatStock->stock;
        // print_r($product->flatStock->stock);
        // echo "</br>";

        // $product->category;
        foreach($product->category as $categoryModel) {
            $item = [
                'id' => $categoryModel->category->id,
                'name' => $categoryModel->category->category
            ];
            array_push($categoryArr, $item);
        }
        // print_r($categoryArr);
        // echo "</br>";
        // $product->customOptionStock;
        foreach($product->customOptionStock as $customOption) {
            $item = [
                'id' => $customOption->id,
                'key' => $customOption->custom_option_key,
                'stock' => $customOption->stock,
                'price' => $customOption->price,
            ];
            array_push($custom_option_arr, $item);
        }
        // print_r($custom_option_arr);
        // echo "</br>";

        $mongoProduct->setAttributes($product->attributes, false);
        $mongoProduct->name = $product->name;
        $mongoProduct->image = $imageArr;
        $mongoProduct->stock = $product->flatStock->stock;
        $mongoProduct->custom_option = $custom_option_arr;
        $mongoProduct->category = $categoryArr;
        $mongoProduct->product_id = intval($this->product_id);
        // $mongoProduct->test = "test1";

        // echo "</br>";
        // print_r($mongoProduct->getAttributes());
        if (!$mongoProduct->save()) {
            print_r($mongoProduct->getFirstErrors());
        }
        print_r(['msg' => '结束消息队列']);
    }
}
