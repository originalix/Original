<?php

namespace backend\controllers;

use Yii;
use backend\models\AddProductForm;
use backend\controllers\BaseController;
use backend\models\UploadImage;
use common\models\Product;
use common\models\ProductImage;
use common\models\CustomOptionStock;

class ProductController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }

    public function actionTest()
    {
        // $this->layout = false;
        $model = new UploadImage();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                print_r(Yii::$app->request->post());
                print_r('验证通过');
                exit();
            } else {
                print_r('验证失败');
                exit();
            }
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionCreate()
    {
        $model = new AddProductForm();
        $imgModel = new UploadImage();
        if ($model->load(Yii::$app->request->post())) {
            $model->image = Yii::$app->request->post('image', []);
            print_r(Yii::$app->request->post());
            exit();
            
            if ($product = $model->createProduct()) {
                if ($model->saveImage($product->id)) {
                    return $this->redirect(['home/index']);
                }
            }
        }
        return $this->render('create', [
            'id' => 0,
            'model' => $model,
            'imgModel' => $imgModel,
            'models' => array(),
        ]);
    }

    public function actionUpdate()
    {
        $id = Yii::$app->request->get('id');
        $model = new AddProductForm();
        $imgModel = new UploadImage();
        // 自定义属性model集合
        $custom_option_models = array();
        if (! is_null($id)) {
            $product = Product::findOne($id);
            $data = $product->attributes;
            $model->setAttributes($data);
            $model->image = $product->image;

            $custom_option_models = CustomOptionStock::find()->where(['product_id' => $id])->all();
            // $model->custom_option = array_values($product->custom_option);
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->image = Yii::$app->request->post('image', []);
            
            if ($product = $model->updateProduct($id)) {
                if ($model->saveImage($product->id)) {
                    return $this->redirect(['home/index']);
                }
            }
        }
        return $this->render('update', [
            'id' => $id,
            'model' => $model,
            'imgModel' => $imgModel,
            'models' => $custom_option_models,
        ]);
    }

    public function actionPjax()
    {
        $product_id = 0;
        $model = new CustomOptionStock();
        if (Yii::$app->request->isPost) {
            print_r(Yii::$app->request->post());
            // exit();
            $model->product_id = Yii::$app->request->post('product_id');
            $product_id = $model->product_id;
            $model->custom_option_key = Yii::$app->request->post('custom_option_key');
            $model->stock = Yii::$app->request->post('stock');
        }

        $models = [];
        if ($product_id === 0) {
            if ($model->save()) {

            } else {
                print_r($model->getFirstErrors());
                exit();
            }
            $models = CustomOptionStock::find()->where(['product_id' => $product_id])->all();
        } else {
            array_push($models, $model);
        }
        
        return $this->render('custom_option_form', [
            'product_id' => $product_id,
            'models' => $models,
        ]);
    }
}
