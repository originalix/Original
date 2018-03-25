<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;
use app\models\HttpRequest;

use EasyWeChat\Foundation\Application;

class EasyController extends BaseController
{
    public function actionResponse()
    {
        $options = [
            'debug'  => true,
            'app_id' => 'your-app-id',
            'secret' => 'you-secret',
            'token'  => 'easywechat',
        
            // 'aes_key' => null, // 可选
        
            'log' => [
                'level' => 'debug',
                'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
            ],
        
            //...
        ];

        return $options;

        // $app = new Application($options);
        
        // $response = $app->server->serve();
        
        // // 将响应输出
        // $response->send(); // Laravel 里请使用：return $response;
    }

    public function actionSend()
    {
        $wechat = Yii::$app->get('wechat');
        //$wechat->app is Easywechat's Application instance
        $wechat->app->server->setMessageHandler(function ($message) {
                    return "hello world！welcome!";
                });
        $wechat->app->server()->send();
    }
}
