<?php

namespace backend\controllers;

use Yii;
use backend\controllers\BaseController;

class HomeController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
