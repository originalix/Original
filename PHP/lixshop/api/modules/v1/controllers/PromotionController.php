<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\product\SalePromotion;
use yii\web\HttpException;

class PromotionController extends BaseController
{
    public function actionDetail($id)
    {
        if (is_null($id)) {
            throw new HttpException(418, '请求参数缺失');
        }

        return SalePromotion::findOne($id);
    }
}
