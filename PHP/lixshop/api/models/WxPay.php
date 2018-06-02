<?php

namespace api\models;

use yii\base\Model;
use api\utils\WeEncryption;
use api\utils\Curl;
use yii\web\HttpException;

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
        $this->encpt = WeEncryption::getInstance();
        $this->encpt->setNotifyUrl($this->url);
        $this->curl = new Curl();
    }

    public function rules()
    {
        return [
            [['body', 'out_trade_no', 'total_fee', 'spbill_create_ip'], 'required'],
            [['total_fee'], 'integer'],
            [['body', 'out_trade_no','spbill_create_ip'], 'string', 'max' => '255'],
        ];
    }

    public function pay()
    {
        if (!$this->validate()) {
            throw new HttpException(418, array_values($this->getFirstErrors())[0]); 
        }

        $data = array (
            'body' => $this->body,
            'out_trade_no' => $this->out_trade_no,
            'total_fee' => $this->total_fee,
            'spbill_create_ip' => $this->spbill_create_ip,
        );

        $xml_data = $this->encpt->sendRequest($this->curl, $data);
        $postObj = $this->encpt->xmlToObject($xml_data);
        
        if ($postObj == false) {
            //
            throw new HttpException(418, '未获取到微信数据'); 
        } 

        if ($postObj->return_code == 'FAIL') {
            throw new HttpException(418, $postObj->return_msg); 
        } else {
            $resignData = array(
        		'appid'			=>	$postObj->appid,
        		'partnerid'		=>	$postObj->mch_id,
        		'prepayid'		=>	$postObj->prepay_id,
        		'noncestr'		=>	$postObj->nonce_str,
        		'timestamp'		=>	time(),
        		'package'	=>	'Sign=WXPay'
    		);
            $sign = $this->encpt->getClientPay($resignData);
            $resignData['sign'] = $sign;
            echo json_encode($resignData);
        }
    }
}

