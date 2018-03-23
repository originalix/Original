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
                    'name' => '点击Click',
                    'type' => 'click',
                    'key' => 'LIX_BUTTON1',
                ],
                [
                    'name' => '网页视图',
                    'sub_button' => [
                        [
                            'type' => 'view',
                            'name' => '百度',
                            'url' => 'https://www.baidu.com',
                        ],
                        [
                            'type' => 'view',
                            'name' => 'Blog',
                            'url' => 'http://originalix.github.io/',
                        ],
                        [
                            'type' => 'view',
                            'name' => '公众平台开发文档',
                            'url' => 'https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421141013',
                        ],
                    ],
                ],
                [
                    'name' => '工具类',
                    'sub_button' => [
                        [
                            'type' => 'pic_photo_or_album',
                            'name' => '拍照或者相册发图',
                            'key' => 'pic_photo_1',
                        ],
                        [
                            'type' => 'location_select',
                            'name' => '发送位置',
                            'key' => 'location_1',
                        ],
                        [
                            'type' => 'scancode_waitmsg',
                            'name' => '扫码带提示',
                            'key' => 'scancode_1',
                        ],
                    ],
                ],
            ],
        ];

        $http = new HttpRequest();
        $data = $http->post($url, $urlParams, json_encode($params, JSON_UNESCAPED_UNICODE));

        return $data;
    }
}
