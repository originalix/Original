<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\modules\v1\models\CategoryListSearch;
use common\models\Category;

class CategoryController extends BaseController
{
    /**
     *  根据category-id获取商品列表
     */
    public function actionList($id)
    {
        $model = new CategoryListSearch();
        return $model->search($id);
    }

    public function actionIndex()
    {
        return Category::find()->all();
    }
}
