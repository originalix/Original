<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadImage extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'extensions' => 'png, jpg, jpeg, gif, bmp', 'mimeTypes' => 'image/jpeg, image/png'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->image->saveAs('uploads/' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }
}
