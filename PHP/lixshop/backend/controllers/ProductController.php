<?php

namespace backend\controllers;

use Yii;

class ProductController extends \yii\web\Controller
{
    public $layout = "home.php";
    public function actionIndex()
    {
        return $this->render('index');
    }
}

