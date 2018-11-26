<?php

namespace console\controllers;

use Yii;
use common\models\Product;
use backend\queues\ProductDataJob;
use common\models\mongodb\Product as MongoProduct;

class ProductController extends \yii\console\Controller
{   
    /**
     * 生成mongodb的product信息
     *
     * @return void
     */
    public function actionGenerate()
    {
        $products = Product::find()->all();
        foreach($products as $product) {
            echo "发送 " . $product->name . "进入消息队列\n";
            echo "产品id: " . $product->id . "\n";
            $this->pushProductToMongo($product->id);
        }
        return 1;
    }

    protected function pushProductToMongo($id)
    {
        Yii::$app->queue->push(new ProductDataJob([
            'product_id' => $id,
        ]));
    }
}
