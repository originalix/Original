<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\helpers\FileHelper;
use yii\web\UploadedFile;

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

    public function actionWx()
    {
    
       $file = UploadedFile::getInstanceByName('image');
       if (is_null($file)) {
        Yii::warning('接收数据 ============= 尚未接收到照片 ==============');
           return '没有获取到图片';
       }
        Yii::warning('接收数据 ============= 接收到照片 ==============');
       return '获取到图片了';
    }
}
