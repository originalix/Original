<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;

class TestController extends BaseController
{
    public function actionIndex()
    {
        return ['code' => 200];
    }
}
