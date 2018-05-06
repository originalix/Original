<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\models\Customer;
use yii\web\HttpException;
use api\models\product\ProductInfo;

class ProductController extends BaseController
{
    public $modelClass = 'api\models\product\ProductSearch';

    /**
     * 获取商品列表——首页
     *
     * @return void
     */
    public function actionIndex()
    {
        $modelClass = new $this->modelClass;
        return $modelClass->search();        
    }

    /**
     * 获取分类列表
     *
     * @return void
     */
    public function actionCategoryList()
    {
        $modelClass = new $this->modelClass;
        return $modelClass->getCategory()->getModels();
    }

    /**
     * 根据分类id 获取商品列表
     *
     * @return void
     */
    public function actionCategory()
    {
        $id = Yii::$app->request->get('id');
        $modelClass = new $this->modelClass;
        return $modelClass->searchByCategoryId($id);
    }

    /**
     * 根据产品id，获取商品信息详情
     *
     * @return void
     */
    public function actionInfo()
    {
        $id = Yii::$app->request->get('id');
        $info = new ProductInfo();
        return $info->search($id);
    }
}
