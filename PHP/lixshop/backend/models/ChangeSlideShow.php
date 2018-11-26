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

class ChangeSlideShow extends Model
{
    public $slideshowArr;

    public function rules()
    {
        return [

        ];
    }
}
