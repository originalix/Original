<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;

class AuthController extends BaseController
{
    public function actionIndex()
    {
        return [
            'access' => 'test'
        ];
    }
}
