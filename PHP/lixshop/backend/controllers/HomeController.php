<?php

namespace backend\controllers;

use Yii;

class HomeController extends \yii\web\Controller
{
    public $layout = "home.php";
    public function actionIndex()
    {
        $this->view->params['customParam'] = 'customValue';
        return $this->render('index');
    }
}
