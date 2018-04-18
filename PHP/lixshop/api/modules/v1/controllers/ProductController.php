<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\models\Customer;
use yii\web\HttpException;

class ProductController extends BaseController
{
    public function actionIndex()
    {
        return ['id' => Yii::$app->user->id];
    }
}
