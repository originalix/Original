<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use yii\web\HttpException;

class FavoriteController extends BaseController
{
    public $modelClass = 'api\models\product\Favorite';

    public function actionIndex()
    {
        $modelClass = new $this->modelClass;
        return $modelClass->getList();
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $modelClass = new $this->modelClass;
        $modelClass->customer_id = Yii::$app->user->identity->id;
        $modelClass->product_id = $request->post('id');
        return $modelClass->createFavorite();
    }

    public function actionView()
    {

    }

    public function actionDelete()
    {

    }
}
