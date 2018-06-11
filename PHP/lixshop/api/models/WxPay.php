<?php

namespace api\models;

use Yii;
use yii\base\Model;
use api\utils\WeEncryption;
use api\utils\Curl;
use yii\web\HttpException;
use common\models\SalesFlatOrder;
use common\models\ChargeOrder;

class WxPay extends Model
{
    const COMMON_ORDER = 1; // 常规订单，正常渠道下单
    const CHARGE_ORDER = 2; // 充值订单
    public $type = 0; // 1 常规订单， 2 充值下单 
    public $body;
    public $out_trade_no;
    public $total_fee;

    public $spbill_create_ip;
    private $encpt;
    private $url;
    private $curl;

    function __construct()
    {
        $this->encpt = WeEncryption::getInstance();
        $this->encpt->setNotifyUrl($this->url);
        $this->curl = new Curl();
        $this->spbill_create_ip = Yii::$app->request->userIP;
        // $this->spbill_create_ip = '127.0.0.1';
    }

    public function rules()
    {
        return [
            [['body', 'out_trade_no', 'total_fee', 'type'], 'required'],
            [['total_fee', 'type'], 'integer'],
            [['body', 'out_trade_no','spbill_create_ip'], 'string', 'max' => '255'],
        ];
    }

    /**
     * 创建常规商品支付的微信订单
     *
     * @return 微信支付object
     */
    public function pay()
    {
        if (!$this->validate()) {
            throw new HttpException(418, array_values($this->getFirstErrors())[0]); 
        }
       
        if ($this->type == static::COMMON_ORDER) {
            $order = SalesFlatOrder::find()
                ->where(['trade_no' => $this->out_trade_no, 'customer_id' => Yii::$app->user->identity->id])
                ->one();

            if (is_null($order)) {
                throw new HttpException(210, '该订单未被创建');
            }

            $this->encpt->setNotifyUrl('https://api.yzl1030.com/v1/wxcallback/index');
        } else if ($this->type == static::CHARGE_ORDER) {
            $order = ChargeOrder::find()
                ->where(['trade_no' => $this->out_trade_no, 'customer_id' => Yii::$app->user->identity->id])
                ->one();

            if (is_null($order)) {
                throw new HttpException(210, '该订单未被创建');
            }
            $this->encpt->setNotifyUrl('https://api.yzl1030.com/v1/wxcallback/charge');
        } else {
            throw new HttpException(210, '订单类型不正确');
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
            throw new HttpException(420, '未获取到微信数据'); 
        } 

        if ($postObj->return_code == 'FAIL') {
            throw new HttpException(422, $postObj->return_msg); 
        } else if ($postObj->result_code == 'FAIL') {
            throw new HttpException(421, $postObj->err_code_des);
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
            return $resignData;
            // return $postObj;
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

