<?php
/*
 * @Author: Lix
 * @Date: 2018-04-03 06:58:05
 * @Last Modified by:   Lix
 * @Last Modified time: 2018-04-03 06:58:05
 */

namespace app\controllers;

use app\controllers\BaseController;
// use yii\web\Controller;
use app\helpers\FileHelper;
// use app\models\UploadImage;
// use yii\web\UploadedFile;
use app\helpers\ImageCompress;
use Yii;

class ImageController extends BaseController
{

    public function actionLog()
    {
        $path = Yii::getAlias('@uploads');
        return ['path' => $path];
    }

    // public function actionUpload()
    // {

    //     $model = new UploadImage();

    //     if (Yii::$app->request->isPost) {
    //         $model->imageFile = UploadedFile::getInstanceByName('image');

    //         if ($model->imageFile && $model->validate()) {
    //             if ($model->upload()) {
    //                 return ['msg' => '上传成功'];
    //             }
    //         } else {
    //             if ($errors = $model->getFirstErrors()) {
    //                 $firstError = current($errors);
    //                 throw new \yii\web\HttpException(404, $firstError);
    //             }
    //             throw new \yii\web\HttpException(404, 'model验证失败');
    //         }
    //     }

    //     return ['code' => 418, 'msg' => '请使用POST请求'];
    // }

    public function actionUpload()
    {
        if (Yii::$app->request->isPost) {
            $data = FileHelper::upload();
            return ['code' => 200, 'data' => $data];
        }

        return ['code' => 200, 'msg' => '请求方法不允许'];
    }

    public function actionCompress()
    {
        $source = '/Users/Lix/Documents/Sites/code-repo/PHP/wxdev/web/uploads/attachments/default/201804/03/400.jpeg';
        // $dst_img = '/Users/Lix/Documents/Sites/code-repo/PHP/wxdev/web/uploads/attachments/default/201804/03/400_compress3.jpeg';
        // $percent = 0.1;
        // $image = (new ImageCompress($source, $percent))->compressImg($dst_img);

        $size = filesize($source)  / 1024;
        // $sizeArr = $this->FileSizeConvert($size);

        return ['msg' => $size];
    }
}
