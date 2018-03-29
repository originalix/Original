<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'f1DSj_7j0cZHffvIxGJJhnfrDZkfr_Qn',
            'enableCsrfValidation' => false,
            'csrfParam' => '_csrf-api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        // 'cache' => [
        //     'class' => 'yii\caching\FileCache',
        // ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => require __DIR__ . '/restful.php',
        ],
        'wechat' => [
            'class' => 'maxwen\easywechat\Wechat',
            // 'userOptions' => []  # user identity class params
            // 'sessionParam' => '' # wechat user info will be stored in session under this key
            // 'returnUrlParam' => '' # returnUrl param stored in session
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
                ]
            ],
        ],
        // 'redis' => [
        //     'class' => 'yii\redis\Connection',
        //     'hostname' => 'localhost',
        //     'port' => 6379,
        //     'database' => 0,
        // ],

        // 'cache' => [
        //     'class' => 'yii\redis\Cache',
        // ],

        // 'session' => [
        //     'name' => 'advanced-frontend',
        //     'class' => 'yii\redis\Session',
        // ],
    ],
    'params' => $params,
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin'
        ]
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
