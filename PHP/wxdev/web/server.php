<?php

// include __DIR__ . '/vendor/autoload.php';

// echo "Hello world";

// use EasyWeChat\Foundation\Application;

// $options = [
//     'debug' => true,
//     'app_id' => 'your-app-id',
//     'secret' => 'you-secret',
//     'token' => 'easywechat',

//     'log' => [
//         'level' => 'debug',
//         'file' => '/tmp/easywechat.log',
//     ],

//     // ...
// ];

// $app = new Application($options);

// $response = $app->server->serve();
// $response->send();


// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// $config = require __DIR__ . '/../config/web.php';

// (new yii\web\Application($config))->run();


use EasyWeChat\Foundation\Application;

$options = [
    'debug' => true,
    'app_id' => 'your-app-id',
    'secret' => 'you-secret',
    'token' => 'easywechat',

    'log' => [
        'level' => 'debug',
        'file' => '/tmp/easywechat.log',
    ],

    // ...
];

$app = new Application($options);

// $response = $app->server->serve();
// $response->send();
