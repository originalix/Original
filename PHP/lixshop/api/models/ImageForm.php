<?php

namespace api\models;

use Yii;
use common\models\Attachment;
use yii\base\Model;

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
        return $this->attachment->save();
    }
}

