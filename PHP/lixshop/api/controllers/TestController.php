<?php

namespace api\controllers;

use Yii;
use yii\filters\auth\CompositeAuth;
use api\filters\HttpApiAuth;
use api\models\Image;
use api\components\BaseController;
use yii\data\ActiveDataProvider;
use yii\web\Link;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;


class TestController extends BaseController
{
    // public function behaviors()
    // {
    //     $behaviors = parent::behaviors();
    //     $behaviors['authenticator'] = [
    //         'class' => CompositeAuth::className(),
    //         'authMethods' => [
    //             HttpApiAuth::className(),
    //         ],
    //     ];

    //     return $behaviors;
    // }
    
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

    public function actionImage()
    {
        $query = Image::find();
        $query->orderBy(['created_at' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

    public function actionProfile()
    {
        return [
            [
                [
                    'icon' => 'dingwei',
                    'title' => '我的签到'
                ],
                [
                    'icon' => 'dingwei',
                    'title' => '我的签到'
                ],
                [
                    'icon' => 'dingwei',
                    'title' => '我的签到'
                ],
                [
                    'icon' => 'dingwei',
                    'title' => '我的签到'
                ],
            ],
            [
                [
                    'icon' => 'dingwei',
                    'title' => '我的签到'
                ],
                [
                    'icon' => 'dingwei',
                    'title' => '我的签到'
                ],
                [
                    'icon' => 'dingwei',
                    'title' => '我的签到'
                ],
                [
                    'icon' => 'dingwei',
                    'title' => '我的签到'
                ],
            ],
            [
                [
                    'icon' => 'dingwei',
                    'title' => '我的签到'
                ],
                [
                    'icon' => 'dingwei',
                    'title' => '我的签到'
                ],
                [
                    'icon' => 'dingwei',
                    'title' => '我的签到'
                ],
                [
                    'icon' => 'dingwei',
                    'title' => '我的签到'
                ],
            ],
        ];
    }

    public function actionOpenid()
    {
        return Yii::$app->user->identity->wechat_openid;
    }
}
