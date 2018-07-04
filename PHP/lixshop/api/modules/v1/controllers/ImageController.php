<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\helpers\FileHelper;

class ImageController extends BaseController
{
    public function actionUpload()
    {
        if (Yii::$app->request->isPost) {
            $data = FileHelper::upload();
            return $data;
        }

        throw new \yii\web\HttpException(418, '请求方法不允许');
    }
}
