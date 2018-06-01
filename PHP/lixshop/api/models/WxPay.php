<?php

namespace api\models;

use yii\base\Model;
use api\utils\WeEncryption;

class WxPay extends Model
{
    public $body;
    public $out_trade_no;
    public $total_fee;
    public $spbill_create_ip;

    private $encpt;
    private $url = '微信回调url';
    private $curl;

    function __construct()
    {

    }
}

