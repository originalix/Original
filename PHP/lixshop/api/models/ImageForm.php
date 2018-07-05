<?php

namespace api\models;

use Yii;
use common\models\Attachment;
use yii\base\Model;
use yii\web\HttpException;

class ImageForm extends Model
{
    public $attachment = null;

    function __construct($data, $type, $type_id)
    {
        $this->attachment = new Attachment();
        $this->attachment->setAttributes([
            'type' => $type,
            'type_id' => $type_id,
            'path' => $data['imgval'],
            'url' => $data['imgurls']['url'],
            'width' => $data['imgurls']['width'],
            'height' => $data['imgurls']['height'],
        ]);
    }

    public function saveImage()
    {
        if (! $this->attachment->validate()) {
            throw new HttpException(418, array_values($this->attachment->getFirstErrors())[0]);
        }
        return $this->attachment->save();
        // if ($this->attachment->save()) {
            // return true;
        // }

        // throw new HttpException(418, array_values($this->attachment->getFirstErrors())[0]);
    }
}

