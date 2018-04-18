<?php

namespace api\controllers;

use Yii;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        throw new \yii\web\HttpException(418, '请求有毒');
    }

    public function actionView()
    {
        return [
            'name' => 'lix',
            'age' => 25,
            'car' => 'crv',
        ];
    }
}
