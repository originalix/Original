<?php

namespace backend\controllers;

use Yii;
use backend\models\AddProductForm;
use backend\controllers\BaseController;
use backend\models\UploadImage;
use common\models\Product;
use common\models\ProductImage;

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
            
            if ($product = $model->createProduct()) {
                if ($model->saveImage($product->id)) {
                    return $this->redirect(['home/index']);
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'imgModel' => $imgModel,
        ]);
    }

    public function actionUpdate()
    {
        $id = Yii::$app->request->get('id');
        $model = new AddProductForm();
        $imgModel = new UploadImage();
        if (! is_null($id)) {
            $product = Product::findOne($id);
            $data = $product->attributes;
            $model->setAttributes($data);
            $model->image = $product->image;
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
            'model' => $model,
            'imgModel' => $imgModel,
        ]);
    }
}

