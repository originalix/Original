<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadImage;
use yii\web\UploadedFile;

class ImageController extends Controller
{
    public function actionUpload()
    {
        $model = new UploadImage;

        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->upload()) {
                return ['msg' => '图片上传成功'];
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
}
