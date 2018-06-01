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

    /**
     * 构造函数，初始化成员变量
     * @param String $appid 小程序id
     * @param Int $mch_id 商户号
     * @prams String $key 秘钥
     */
    private function __construct()
    {
        if (is_string($appid) && is_string($mch_id)) {
            $this->appid = Yii::$app->params['APP_ID'];
            $this->mch_id = Yii::$app->params['MCH_ID'];
            $this->key = Yii::$app->params['APP_SECRET'];
        }
    }

    /**
     * 获取当前实例
     * @return WeEncryption 实例
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance == new Self(); 
        }
        return self::$instance;
    }

    /**
     *  发送下单请求
     *  @param Curl $curl 请求资源句柄
     *  @param mixed 请求返回数据
     */
    public function sendRequest(Curl $curl, $data)
    {
        $data = $this->setSendData($data);
        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
        $curl->setUrl($url);
        $content = $curl->execute(true, 'POST', $data);
        return $content;
    }
}

