<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\models\Customer;
use yii\web\HttpException;

class ProductController extends BaseController
{
    public $modelClass = 'api\models\product\ProductSearch';

    public function actionIndex()
    {
        $modelClass = new $this->modelClass;
        return $modelClass->search();        
    }

    public function actionCategoryList()
    {
        $modelClass = new $this->modelClass;
        return $modelClass->getCategory()->getModels();
    }

    public function actionCategory()
    {
        $modelClass = new $this->modelClass;
        return $modelClass->searchByCategoryId(3);
    }
}
