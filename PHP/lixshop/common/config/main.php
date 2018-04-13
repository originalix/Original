<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => [
        'redactor' => 'yii\redactor\RedactorModule',
        'uploadDir' => '/Users/Lix/Documents/www/sites/code-repo/PHP/lixshop/files',
        'uploadUrl' => 'http://localhost/code-repo/PHP/lixshop/files',
        'imageAllowExtensions'=>['jpg','png','gif'],
    ],
];
