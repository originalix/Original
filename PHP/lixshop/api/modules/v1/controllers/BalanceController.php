<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\models\BalanceLog;
use yii\data\ActiveDataProvider;

class BalanceController extends BaseController
{
    public function actionLog()
    {
        $query = BalanceLog::find()
           ->where(['customer_id' => Yii::$app->user->identity->id]); 
        $query->orderBy(['created_at' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }
}

