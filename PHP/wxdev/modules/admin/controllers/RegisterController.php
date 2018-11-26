<?php

namespace app\modules\admin\controller;

use Yii;
use app\controllers\BaseController;
use app\models\HttpRequest;

class TestController extends BaseController
{
    public function actionIndex()
    {
        return ['code' => 200];
    }
}
