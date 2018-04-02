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
        
        $model = new UploadImage();
        
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstanceByName('image');
            
            if ($model->imageFile && $model->validate()) {
                if ($model->upload()) {
                    return ['msg' => '上传成功'];
                }
            } else {
                if ($errors = $model->getFirstErrors()) {
                    $firstError = current($errors);
                    throw new \yii\web\HttpException(404, $firstError);
                }
                throw new \yii\web\HttpException(404, 'model验证失败');
            }
        }

        return ['code' => 418, 'msg' => '请使用POST请求'];
    }
}
