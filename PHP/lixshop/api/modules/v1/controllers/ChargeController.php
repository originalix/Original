<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\charge\ChargeProductSearch;

class ChargeController extends BaseController
{
    public function actionList()
    {
        $model = new ChargeProductSearch();
        return $model->search();
    }

    public function actionMock()
    {
        $model = new ChargeProductSearch();
        return $model->mock();
    }
}
