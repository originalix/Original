<?php

$modules = [
    'vi' => [
        'class' => 'api\modules\v1\Module',
    ]
];

if (YII_ENV_DEV && file_exists(__DIR__ . '/modules-local.php')) {
    $modules = call_user_func_array(['yii\helpers\ArrayHelper', 'merge'], [
        $modules,
        require(__DIR__ . '/modules-local.php'),
    ]);
}

return $modules;
