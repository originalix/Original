<?php

include __DIR__ . '/vendor/autoload.php';

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

$response = $app->server->serve();
$response->send();
