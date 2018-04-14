<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\mongodb\Product;

class Img extends Model
{
    public $image;

    public function rules()
    {
        return [
            // ['image', 'required', 'message' => '{attribute}不能为空.'],
        ];
    }
}
