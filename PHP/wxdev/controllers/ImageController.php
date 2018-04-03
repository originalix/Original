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
        $filename = '400.jpg';
        $info = FileHelper::imgCompress($source, $filename);
        return ['msg' => $info];
    }
}
