<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use yii\web\HttpException;

class FavoriteController extends BaseController
{
    public $modelClass = 'api\models\product\Favorite';

    /**
     * 获取收藏列表
     *
     * @return void
     */
    public function actionIndex()
    {
        $modelClass = new $this->modelClass;
        return $modelClass->getList();
    }

    /**
     * 添加商品至收藏
     *
     * @return void
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $modelClass = new $this->modelClass;
        $modelClass->customer_id = Yii::$app->user->identity->id;
        $modelClass->product_id = $request->post('id');
        return $modelClass->createFavorite();
    }

    /**
     * 删除收藏
     *
     * @return void
     */
    public function actionDelete()
    {
        $id = Yii::$app->request->getBodyParam('id');
        $modelClass = new $this->modelClass;
        return $modelClass->deleteFavorite($id);
    }
}
