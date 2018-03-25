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
            'csrfParam' => '_csrf-api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
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
        'wechat'=>[
            'class'=>'app\models\Wechat',
            //the config is all most match the easyWechat office's config,
            //the diffenrece please see Notice
            'config'=>[                
                'debug'  => true,                
                'app_id'=>'',
                'secret'=>'',
                'token'=>'',
                'aes_key'=>'',
                'payment'=>[                   
                    'merchant_id'=>'',
                    'key'=>'',                    
                    'cert_path'=>'',
                    'key_path'=>'',                    
                    'notify_url'=>''

                ],               
                'oauth' => [
                    'scopes'   => ['snsapi_userinfo'],
                    'callback' => '/examples/oauth_callback.php',
                ],
                'guzzle' => [
                    'timeout' => 3.0, //
                    //'verify' => false, // close SSL verify（not suggust！！！）
                ],                
                /**
                 * Cache,if not set ,use Yii default config cache
                 */
                'cache'=>[

                ],
            ],
        ],
    ],
    'params' => $params,
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
