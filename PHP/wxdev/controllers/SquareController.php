<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;
use app\models\HttpRequest;

class SquareController extends BaseController
{
    public function actionOrigin()
    {
        return ['code' => 200];
    }
}
