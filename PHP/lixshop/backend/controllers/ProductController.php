<?php

namespace backend\controllers;

use Yii;
use backend\models\AddProductForm;
use backend\controllers\BaseController;
use backend\models\Img;

class ProductController extends BaseController
{
    public function actionIndex()
    {
        // $this->layout = false;
        $model = new Img();

        if ($model->load(Yii::$app->request->post())) {
            print_r(Yii::$app->request->post());
            exit();
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionTest()
    {
        // $this->layout = false;
        $model = new Img();
        if (Yii::$app->request->isPost) {
            // print_r(Yii::$app->request->post());
            // exit();
            // print_r($model->getFirstErrors());
            // exit();
            if ($model->load(Yii::$app->request->post())) {
                // print_r(Yii::$app->request->post());
                print_r('验证通过');
                exit();
            } else {
                print_r('验证失败');
                // print_r($model->image);
                // print_r(Yii::$app->request->post('image'));
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
        if ($model->load(Yii::$app->request->post())) {
            print_r(Yii::$app->request->post());
            exit();
            if ($product = $model->createProduct()) {
                return $this->goHome();
            } else {
                print_r("Hello world");
                print_r($product);
                // return;
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}

