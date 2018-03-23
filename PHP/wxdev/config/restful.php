<?php

return [
    // 微信接口路由
    '/wxapi/<action:\w+>' => 'w-x-api/<action>',
    '/wxapi/get-access-token' => 'w-x-api/get-access-token',
    '/wxapi/set-menu' => 'w-x-api/set-menu',
    '/wxapi/query-menu' => 'w-x-api/query-menu',
    '/wxapi/delete-menu' => 'w-x-api/delete-menu',

    //全局
    '/<controller:\w+>/<id:\d+>' => '/<controller>/view',
    '/<controller:\w+>/<action:\w+>' => '/<controller>/<action>',
    '<module>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
    '<module>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
];
