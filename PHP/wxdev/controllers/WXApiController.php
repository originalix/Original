<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;
use app\models\HttpRequest;

class WXApiController extends BaseController
{
    public function actionIndex()
    {
        return ['msg' => 'this is WX API Controller'];
    }
    /**
     * 获取微信的access_token
     *
     * @return JSON
     */
    public function actionGetAccessToken()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/token';

        $params = [
            'grant_type' => 'client_credential',
            'appid' => Yii::$app->params['WX_APP_ID'],
            'secret' => Yii::$app->params['WX_APP_SECRET'],
        ];
        
        $http = new HttpRequest();
        $jsonData = $http->get($url, $params);

        return [
            'msg' => '获取微信Access_Token成功',
            'access_token' => $jsonData->access_token,
            'expires_in' => $jsonData->expires_in,
        ];
    }

    public function actionSetButton()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create';
        $urlParams = [
            'access_token' => Yii::$app->params['WX_ACCESS_TOKEN']
        ];

        $params = [
            'button' => [
                [
                    'name' => 'button1',
                    'type' => 'click',
                    'key' => 'LIX_BUTTON1',
                ],
                [
                    'name' => 'button2',
                    'type' => 'click',
                    'key' => 'LIX_BUTTON2',
                ],
                [
                    'name' => 'button3',
                    'type' => 'click',
                    'key' => 'LIX_BUTTON3',
                ],
            ],
        ];

        $http = new HttpRequest();
        $data = $http->post($url, $urlParams, $params);
        // print_r($data);

        // return ['code' => 200];
    }
}
