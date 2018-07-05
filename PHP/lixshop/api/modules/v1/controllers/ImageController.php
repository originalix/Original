<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\helpers\FileHelper;
use yii\web\UploadedFile;
use common\models\Attachment;
use api\models\ImageForm;

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

    public function actionAppointment()
    {
        if (! Yii::$app->request->isPost) {
            throw new \yii\web\HttpException(418, '请求方法不允许');
        }


        $data = FileHelper::upload();
        if ($data['status'] === false) {
            throw new \yii\web\HttpException(419, '图片保存到服务器失败');
        }

        $type = 'appointment';
        $type_id = Yii::$app->request->post('type_id');
        // if (is_null($type_id)) {
            // throw new \yii\web\HttpException(420, '缺少关键参数');
        // }
        $imageForm = new ImageForm($data, $type, $type_id);

        
        if ($imageForm->saveImage()) {
            return $imageForm;
        }

        throw new \yii\web\HttpException(421, '图片存储失败');
    }
}
