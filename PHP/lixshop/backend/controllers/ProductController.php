<?php

namespace backend\controllers;

use Yii;
use backend\models\AddProductForm;

class ProductController extends \yii\web\Controller
{
    public $layout = "home.php";
    public function actionIndex()
    {
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

