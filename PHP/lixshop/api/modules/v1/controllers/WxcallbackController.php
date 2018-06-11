<?php

namespace api\modules\v1\controllers;

use Yii;
use api\utils\WeEncryption;
use common\models\WxOrderNotify;
use common\models\SalesFlatOrder;
use common\models\ChargeOrder;
use common\models\Customer;
use common\models\BalanceLog;

class WxcallbackController extends \yii\web\Controller
{
    public function actionTest()
    {
        Yii::warning('接收数据 ============= start ==============', 'order');
        $postXML = $GLOBALS["HTTP_RAW_POST_DATA"];
        Yii::warning($postXML, 'order');
        Yii::warning('接收数据 ============= end ==============', 'order');
        Yii::warning('测试订单回调', 'order');
        return ['code' => 200];
    }

    /**
     * 常规商品支付的微信回调
     *
     * @return xml
     */
    public function actionIndex()
    {
        Yii::warning('接收数据 ============= start ==============', 'order');
        $postXML = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
        Yii::warning($postXML, 'order');
        Yii::warning('接收数据 ============= end ==============', 'order');
        Yii::warning('订单回调', 'order');

        // 接收解析数据，并保存入数据库
        $encpt = WeEncryption::getInstance();
        $obj = $encpt->getNotifyData();
        if ($obj) {
            $array =  $this->object2array($obj);
            $model = WxOrderNotify::find()
                ->where(['out_trade_no' => $array['out_trade_no']])
                ->one();
            if (is_null($model)) {
                $model = new WxOrderNotify();
            }
            $model->setAttributes($array, false);
            $model->save();
        }

        // 拷贝数组 去除里面的sign字段签名
        $data = $array;
        $data = $this->array_remove($data, 'sign');
        $sign = $encpt->getSign($data);
        if ($sign == $obj['sign']) {
            Yii::warning('签名校验成功', 'order');
            $this->updateOrder($obj['out_trade_no'], $obj['transaction_id']);
            $reply = "<xml>
					<return_code><![CDATA[SUCCESS]]></return_code>
					<return_msg><![CDATA[OK]]></return_msg>
				</xml>";
        } else {
            Yii::warning('签名校验失败', 'order');
            $reply = "<xml>
					<return_code><![CDATA[FAIL]]></return_code>
					<return_msg><![CDATA[签名失败]]></return_msg>
				</xml>";
        }

		echo $reply;
    }

    /**
     * 充值类型订单的微信支付回调
     *
     * @return xml
     */
    public function actionCharge()
    {
        Yii::warning('接收数据 ============= start ==============', 'order');
        $postXML = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
        Yii::warning($postXML, 'order');
        Yii::warning('接收数据 ============= end ==============', 'order');
        Yii::warning('订单回调', 'order');

        // 接收解析数据，并保存入数据库
        $encpt = WeEncryption::getInstance();
        $obj = $encpt->getNotifyData();
        if ($obj) {
            $array =  $this->object2array($obj);
            $model = WxOrderNotify::find()
                ->where(['out_trade_no' => $array['out_trade_no']])
                ->one();
            if (is_null($model)) {
                $model = new WxOrderNotify();
            }
            $model->setAttributes($array, false);
            $model->save();
        }

        // 拷贝数组 去除里面的sign字段签名
        $data = $array;
        $data = $this->array_remove($data, 'sign');
        $sign = $encpt->getSign($data);
        if ($sign == $obj['sign']) {
            Yii::warning('签名校验成功', 'order');
            // $this->updateOrder($obj['out_trade_no']);
            $this->updateChargeOrder($obj['out_trade_no'], $obj['transaction_id']);
            $reply = "<xml>
					<return_code><![CDATA[SUCCESS]]></return_code>
					<return_msg><![CDATA[OK]]></return_msg>
				</xml>";
        } else {
            Yii::warning('签名校验失败', 'order');
            $reply = "<xml>
					<return_code><![CDATA[FAIL]]></return_code>
					<return_msg><![CDATA[签名失败]]></return_msg>
				</xml>";
        }

		echo $reply;
    }

    /**
     *  PHP中对象转换成数组
     */
    function object2array(&$object)
    {
        $object =  json_decode( json_encode( $object),true);
        return  $object;
    }
    
    /**
     *  从数组中移除key值
     */
    function array_remove($data, $key)
    {  
        if(!array_key_exists($key, $data)) {  
            return $data;  
        }  
        $keys = array_keys($data);  
        $index = array_search($key, $keys);  
        if($index !== FALSE) {  
            array_splice($data, $index, 1);  
        }  
        return $data;  
    }

    function updateOrder($trade_no, $txn_id)
    {
        $order = SalesFlatOrder::find()
            ->where(['trade_no' => $trade_no])
            ->one();
        $order->payment_method = 'wechat';
        $order->order_status = 2;
        $order->txn_id = $txn_id;
        $order->save();
    }

    function updateChargeOrder($trade_no, $txn_id)
    {
        $order = ChargeOrder::find()
            ->where(['trade_no' => $trade_no])
            ->one();
        $order->payment_method = 'wechat';
        $order->txn_id = $txn_id;
        $order->order_status = 3;
        $order->save();
        $this->updateCustomerCharge($order->total_amount, $order->customer_id);
    }
    
    /**
     * 更新用户余额字段 更新充值日志表记录
     */
    function updateCustomerCharge($total_amount, $customer_id)
    {
        $customer = Customer::findOne($customer_id);
        $new_charge = $customer->charge + $total_amount;
        $customer->charge = $new_charge;
        $customer->save();

        $log = new BalanceLog();
        $log->customer_id = $customer_id;
        $log->type = 2;
        $log->amount = $total_amount;
        $log->mark = '充值'.$total_amount.'元';
        $log->balance = $customer->charge;
        $log->save();
    }

    // public function actionLog()
    // {
        // $customer_id = 3;
        // $total_amount = 0.01;
        // $log = new BalanceLog();
        // $log->customer_id = $customer_id;
        // $log->type = 2;
        // $log->amount = $total_amount;
        // $log->mark = '充值'.$total_amount.'元';
        // $log->balance = $total_amount;
        // if ($log->save()) {
            // return ['msg' => '保存成功'];
        // } else {
            // return $log->getFirstErrors();
        // }
    // }
}

