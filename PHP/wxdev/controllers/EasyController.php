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
        Yii::error('=======Request start=======');

        $server = Yii::$app->wechat->server;

        $server->setMessageHandler(function($message) {
            switch ($message->MsgType) {
                case 'event':
                    return '收到事件消息';
                    break;
                case 'text':
                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
        });

        $response = $server->serve();
        $response->sendContent();
        Yii::error('=======Request end=======');
    }

    public function actionLog()
    {
        Yii::error('========error=======');
    }
}
