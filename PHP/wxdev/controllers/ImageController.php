<?php

namespace app\controllers;

use Yii;
// use yii\web\Controller;
use app\controllers\BaseController;
use app\models\UploadImage;
use yii\web\UploadedFile;

class ImageController extends BaseController
{
    public function actionUpload()
    {
        $model = new UploadImage;

        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->upload()) {
                return ['code' => 200, 'msg' => '图片上传成功'];
            } else {
                if ($errors = $model->getFirstErrors()) {
                    $firstError = current($errors);
                    return ['msg' => $firstError];
                }
                return ['code' => 418, 'msg' => '图片保存失败'];
            }
        }

        return ['code' => 418, 'msg' => '请使用POST请求'];
    }
}
