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
            $redis->set($key, 'Leon');
            $redis->expire($key, 5);
        }

        return ['redis' => 'no data'];
    }

    public function actionCache()
    {
        $cache = Yii::$app->cache;
        $key = 'username';

        if ($cache->exists($key)) {
            return ['cache' => $cache->get($key)];
        } else {
            $cache->set($key, 'Leon', 5);
        }

        return ['cache' => 'no cache'];
    }

    public function actionSession()
    {
        $session = Yii::$app->session;
        $key = 'username';
        if ($session->has($key)) {
            return ['session' => $session->get($key)];
        } else {
            $session->set($key, 'Leon');
        }
        return ['session' => 'no session'];
    }

    public function actionSina()
    {
        $url = 'https://api.weibo.com/oauth2/authorize';

        $params = [
            'client_id' => '2686997579',
            'redirect_uri' => 'http://139.199.105.54/code-repo/PHP/wxdev/web/site/index',
        ];

        // $http = new HttpRequest();
        // $data = $http->get($url);
        // print_r($data);
        // return $data;

        // $url1 = "https://api.weibo.com/oauth2/authorize?client_id=2686997579&redirect_uri=http://www.sina.com";

        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_URL, $url1);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // $data = curl_exec($curl);
        // curl_close($curl);

        print_r($data);
    }

    public function actionHome()
    {
        $url = 'https://api.weibo.com/2/statuses/home_timeline.json';

        $params = [
            'access_token' => '2.00LuOaLCdo3qvC1055521a7aoyzyVE',
        ];

        $http = new HttpRequest();
        $data = $http->get($url, $params);
        return $data;
    
    }

    public function actionUser()
    {
        $url = 'https://api.weibo.com/2/statuses/user_timeline.json';

        $params = [
            'access_token' => '2.00LuOaLCdo3qvC1055521a7aoyzyVE',
            // 'screen_name' => '复古老照片',
            // 'uid' => 4222916210413198,
        ];

        $http = new HttpRequest();
        $data = $http->get($url, $params);
        // print_r($data);
        return $data;
    }
}

// 290067ca09420fe37be1b86272f56865
