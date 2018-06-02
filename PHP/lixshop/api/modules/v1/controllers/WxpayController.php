<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use api\models\WxPay;

class WxpayController extends BaseController
{
    public function actionCreate()
    {
        $model = new WxPay();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $model->pay();
        }

        return ['msg' => '请重试请求'];
    }

    public function actionCallback()
    {
        $model = new WxPay();
        $obj = $model->encpt->getNotifyData();
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
            $sign = $model->encpt->getSign($data);
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
}

