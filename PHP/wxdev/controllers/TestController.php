<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;
use app\models\HttpRequest;

class TestController extends BaseController
{
    public function actionIndex()
    {
        return ['code' => 200];
    }

    /**
     * POST接口测试 直接输出传入参数
     *
     * @return void
     */
    public function actionPost()
    {
        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            
            return $postData;
        } else {
            return ['methos' => 'get'];
        }
    }

    /**
     * 发送POST请求
     *
     * @return JSON
     */
    public function actionSend()
    {
        $url = 'http://originalix.xyz/code-repo/PHP/wxdev/web/test/post';
        // $params = [
        //     'name' => 'Wsxxxx',
        // ];

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
        
        // print_r(json_encode($params));
        // exit();

        $http = new HttpRequest();
        $data = $http->post($url, null, json_encode($params));

        return $data;
    }

    public function actionUrl()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/get';
        $url = HttpRequest::generateWXUrl($url);
        print_r($url);
    }

    public function actionRedis()
    {
        $redis = Yii::$app->redis;
        $key = 'username';
        if ($val = $redis->get($key)) {
            return ['redis' => $val];
        } else {
            $redis->set($key, 'marko');
            $redis->expire($key, 5);
        }

        return ['redis' => 'no data'];
    }
}
