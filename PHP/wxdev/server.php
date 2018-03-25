<?php

include __DIR__ . '/vendor/autoload.php'; // 引入 composer 入口文件

use EasyWeChat\Foundation\Application;

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

$app = new Application($options);

// $response = $app->server->serve();

// 将响应输出
// $response->send(); // Laravel 里请使用：return $response;
