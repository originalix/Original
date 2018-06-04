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
        // $postXML = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postXML = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
        Yii::warning($postXML, 'order');
        Yii::warning('接收数据 ============= end ==============', 'order');
        Yii::warning('订单回调', 'order');

        $encpt = WeEncryption::getInstance();
        $obj = $encpt->getNotifyData();
        if ($obj) {
            Yii::warning('转换成json格式', 'order');
            Yii::warning($obj, 'order');
            $model = new WxOrderNotify();
            $model->load($obj, '');
            $model->save();
        }

        $reply = "<xml>
					<return_code><![CDATA[SUCCESS]]></return_code>
					<return_msg><![CDATA[OK]]></return_msg>
				</xml>";
		echo $reply;

        return ['code' => 200];
    }
}
