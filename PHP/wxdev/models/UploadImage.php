<?php

namespace api\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadImage extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $imageFile;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'mimeTypes' => 'image/jpeg, image/png'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('/Users/Lix/Documents/Sites/lntsapp/apps/api/web/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
