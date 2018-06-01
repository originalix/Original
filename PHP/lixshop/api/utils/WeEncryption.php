<?php

namespace api\utils;

use Yii;
use api\utils\Curl;

class WeEncryption
{
    private static $instance;
    private $sTpl;
    private $appid;
    private $mch_id;
    private $key;
    private $notify_url;
    private $trade_type = 'APP';
    private static $details;

    private function __construct()
    {
        if (is_string($appid) && is_string($mch_id)) {
            $this->appid = Yii::$app->params['APP_ID'];
            $this->mch_id = Yii::$app->params['MCH_ID'];
            $this->key = Yii::$app->params['APP_SECRET'];
        }
    }
}

