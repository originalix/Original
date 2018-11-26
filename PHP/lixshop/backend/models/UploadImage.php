<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\mongodb\Product;

class UploadImage extends Model
{
    public $image;

    public function rules()
    {
        return [
        ];
    }
}
