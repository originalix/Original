<?php

namespace api\modules\v1\controllers;

use Yii;
use api\utils\WeEncryption;
use common\models\WxOrderNotify;

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

    public function actionIndex()
    {
        Yii::warning('接收数据 ============= start ==============', 'order');
        $postXML = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
        Yii::warning($postXML, 'order');
        Yii::warning('接收数据 ============= end ==============', 'order');
        Yii::warning('订单回调', 'order');

        $encpt = WeEncryption::getInstance();
        $obj = $encpt->getNotifyData();
        if ($obj) {
            Yii::warning('接收XML数据', 'order');
            $model = new WxOrderNotify();
            $array =  $this->object2array($obj);
            $model->setAttributes($array, false);
            Yii::warning($array, 'order');
            $model->save();
        }

        $reply = "<xml>
					<return_code><![CDATA[SUCCESS]]></return_code>
					<return_msg><![CDATA[OK]]></return_msg>
				</xml>";
		echo $reply;

        return ['code' => 200];
    }

    function object2array(&$object) {
             $object =  json_decode( json_encode( $object),true);
             return  $object;
    }
}
