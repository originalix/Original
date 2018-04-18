<?php

namespace api\controllers;

use Yii;
use yii\filters\auth\CompositeAuth;
use api\filters\HttpApiAuth;

class TestController extends \yii\web\Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpApiAuth::className(),
            ],
        ];

        return $behaviors;
    }
    
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

    public function actionAuth()
    {
        $authHeader = "Bearer LixLixLix";
        preg_match('/^Bearer\s+(.*?)$/', $authHeader, $matches);
        return [
            'matches' => $matches[1],
            'access_token' => Yii::$app->security->generateRandomString()
        ];
    }
}
