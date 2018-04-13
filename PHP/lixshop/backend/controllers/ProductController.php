<?php

namespace backend\controllers;

use Yii;
use backend\models\AddProductForm;
use backend\controllers\BaseController;

class ProductController extends BaseController
{
    public function actionIndex()
    {
        $this->layout = false;
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new AddProductForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($product = $model->createProduct()) {
                return $this->goHome();
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}

