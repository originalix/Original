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
            $img_arr=$_FILES["image"];
            return ['code' => 200, 'file' => $img_arr];
            if ($model->load(Yii::$app->request->post())) {     
                $model->image = UploadedFile::getInstance($model, 'image');
                $model->image = $_FILES('image');
                return ['code' => 200, 'image' => $model->image];
                if ($model->upload()) {
                    return ['code' => 200, 'msg' => '图片上传成功'];
                } else {
                    if ($errors = $model->getFirstErrors()) {
                        $firstError = current($errors);
                        return ['code' => 200, 'msg' => $firstError];
                    }
                    return ['code' => 200, 'msg' => '图片保存失败'];
                }
            // } else {
            //     return ['code' => 200, 'msg' => '读取信息失败', 'data' => Yii::$app->request->post()];
            // }
        }

        return ['code' => 418, 'msg' => '请使用POST请求'];
    }
}
