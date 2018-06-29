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
        $created_time = date("y-m-d", strtotime(Yii::$app->user->identity->access_token_created_at));
        if (strtotime($now_time) == strtotime($created_time)) {
            //当天创建账户
        } else {
            // 不是当天创建账户
        }

        return [
        ];
    }
}
