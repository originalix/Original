<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\models\CreditLog;
use yii\data\ActiveDataProvider;

class CreditController extends BaseController
{
    public function actionLog()
    {
        $query = CreditLog::find()
            ->where(['customer_id' => Yii::$app->user->identity->id]);
        $query->orderBy(['created_at' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }
}

