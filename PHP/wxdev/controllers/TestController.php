<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class TestController extends Controller
{
    public function beforeAction($action)
    {
        return Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public function actionIndex()
    {
        return ['code' => 200];
    }
}
