<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\models\Customer;
use yii\web\HttpException;

class ShareController extends BaseController
{
    /**
     * 推荐有礼的判断函数
     */
    public function actionIndex($recommend_id)
    {
        $referees =  Customer::findOne($recommend_id);
        if (is_null($referees)) {
            throw new HttpException(419, '推荐人不存在');
        }

        $uid = Yii::$app->user->identity->id;
        $now_time = date("y-m-d");
        $test_time = date("y-m-d", strtotime(Yii::$app->user->identity->created_at));
        return [
            'a' => $now_time,
            'b' => $test_time,
        ];
    }
}
