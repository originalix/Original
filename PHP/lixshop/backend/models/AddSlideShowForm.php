<?php

namespace backend\models;

use Yii;
use common\models\SlideShow;
use yii\base\Model;
use common\ToolBox\ToolExtend;  
use yii\helpers\FileHelper;  
use yii\helpers\Html;  
use yii\helpers\Url;  
use yii\imagine\Image;
use yii\web\UploadedFile;
class AddSlideShowForm extends Model
{
    public $title;
    public $imageFile;

    public function rules()
    {
        return [
            [['title', 'imageFile'], 'required', 'message' => '{attribute}不能为空'],
            ['title', 'string', 'max' => 255],
            ['imageFile', 'file'],
        ];
    }

    public function saveSlideShow()
    {
        if (! $this->validate()) {
            return null;
        }

        $dir = '/uploads/temp/';  
        //生成唯一uuid用来保存到服务器上图片名称  
        $pickey = ToolExtend::genuuid();  
        $filename = $pickey . '.' . $this->imageFile->getExtension();

        //如果文件夹不存在，则新建文件夹  
        if (!file_exists(Yii::getAlias('@backend') . '/web' . $dir)) {  
            FileHelper::createDirectory(Yii::getAlias('@backend') . '/web' . $dir, 777);  
        }
        $filepath = realpath(Yii::getAlias('@backend') . '/web' . $dir) . '/';  
        $file = $filepath . $filename;
        if ($this->imageFile->saveAs($file)) {
            $model = new SlideShow();
            $model->title = $this->title;
            $model->path = $file;
            $model->filename = $filename;
            $is_usage = false;
            return $model->save();
        }

        return null;
    }
}
