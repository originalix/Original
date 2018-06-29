<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\models\Customer;
use yii\web\HttpException;
use common\models\Referees;
use api\models\coupon\CouponUsage;

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

        if ($uid == $recommend_id) {
            throw new HttpException(417, '推荐无效');
        }

        $now_time = date("y-m-d");
        $created_time = date("y-m-d", strtotime(Yii::$app->user->identity->access_token_created_at));
        if (strtotime($now_time) != strtotime($created_time)) {
            //不是当天创建账户
            throw new HttpException(420, '已经是注册会员');
        }

        // 确定没有推荐关系
        $referees_record = Referees::find()
            ->where(['customer_id' => $uid])
            ->one();
        if (! is_null($referees_record)) {
            if (! is_null ($referees_record->referees_id)) {
                throw new HttpException(421, '已经被推荐加入衣之恋');
            }
        }

        // 存储推荐关系 
        $referees = new Referees();
        $referees->customer_id = $uid;
        $referees->referees_id = $recommend_id;
        $referees->save();
        
        // 发放优惠券
        $model = new CouponUsage();
        $model->coupon_id = 1;
        $model->customer_id = $recommend_id;
        $model->is_used = 1;
        if ($model->save()) {
            return [
                'referees' => $referees,
            ];
        } else { 
            throw new HttpException(422, '给推荐人的优惠券发放失败');
        }
    }
}

