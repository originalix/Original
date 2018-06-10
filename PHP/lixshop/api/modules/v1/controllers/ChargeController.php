<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\charge\ChargeProductSearch;

class ChargeController extends BaseController
{
    /**
     * 获取充值金额列表
     *
     * @return array 充值列表
     */
    public function actionList()
    {
        $model = new ChargeProductSearch();
        return $model->search();
    }

    // mock 充值数据
    public function actionMock()
    {
        $model = new ChargeProductSearch();
        return $model->mock();
    }

    public function actionCreate()
    {

    }
}
