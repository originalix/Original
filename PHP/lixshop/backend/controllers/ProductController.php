<?php

namespace backend\controllers;

use Yii;
use backend\models\AddProductForm;
use backend\controllers\BaseController;
use backend\models\UploadImage;

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
                return $this->redirect(['home/index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'imgModel' => $imgModel,
        ]);
    }
}

