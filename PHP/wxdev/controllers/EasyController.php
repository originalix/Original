<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;
use app\models\HttpRequest;

class EasyController extends \yii\web\Controller
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
        Yii::info('request arrived.', __METHOD__);

        $server = Yii::$app->wechat->server;

        $server->setMessageHandler(function($message) {
            return "您好！欢迎关注我!";
        });

        $response = $server->serve();
        $response->send();
        Yii::info('return response.', __METHOD__);
    }
}
