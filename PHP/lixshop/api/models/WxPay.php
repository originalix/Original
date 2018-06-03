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
                'appId'			=>	$postObj->appid,
                'timeStamp'		=>	time(),
                'nonceStr'		=>	$this->encpt->getNonceStr(),
                'package'	=>	'prepay_id='.$postObj->prepay_id,
                'signType' => 'MD5',
            );
            $sign = $this->encpt->getClientPay($resignData);
            $resignData['sign'] = $sign;
            return json_encode($resignData);
            return $postObj;
        }
    }

    public function callBack()
    {
        $obj = $this->encpt->getNotifyData();
        if ($obj == false) {
            exit;
        } 

        if ($obj) {
            $data = array(
                'appid'				=>	$obj->appid,
                'mch_id'			=>	$obj->mch_id,
                'nonce_str'			=>	$obj->nonce_str,
                'result_code'		=>	$obj->result_code,
                'openid'			=>	$obj->openid,
                'trade_type'		=>	$obj->trade_type,
                'bank_type'			=>	$obj->bank_type,
                'total_fee'			=>	$obj->total_fee,
                'cash_fee'			=>	$obj->cash_fee,
                'transaction_id'	=>	$obj->transaction_id,
                'out_trade_no'		=>	$obj->out_trade_no,
                'time_end'			=>	$obj->time_end
            );
        }

        $sign = $encpt->getSign($data);

        if ($sign == $obj->sign) {
            $reply = "<xml>
					<return_code><![CDATA[SUCCESS]]></return_code>
					<return_msg><![CDATA[OK]]></return_msg>
				</xml>";
		    echo $reply;
		    exit;
        }
    }
}

