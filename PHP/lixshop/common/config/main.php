<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'timeZone' => 'Asia/Shanghai',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@app/runtime/logs/' . date('Ym/d') . '.log',
                    'logVars' => ['_GET', '_POST'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'logFile' => '@app/runtime/debug/' . date('Ym/d') . '.log',
                    'logVars' => ['_GET', '_POST'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['order'],
                    'levels' => ['error', 'warning'],
                    'logVars' => ['*'],
                    'logFile' => '@app/runtime/logs/order.log',
                ],
            ],
        ],
    ],
    'modules' => [
        'redactor' => [ 
            'class' => 'yii\redactor\RedactorModule', 
            'imageAllowExtensions'=>['jpg','png','gif'] 
        ], 
    ],
];
