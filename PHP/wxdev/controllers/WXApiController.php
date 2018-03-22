<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;

class WXApiController extends BaseController
{
    public function actionIndex()
    {
        return ['msg' => 'this is WX API Controller'];
    }

    public function actionGetAccessToken()
    {
        $grant_type = 'client_credential';
        $appid = 'wx543ed3903a242eb6';
        $secret = '972d0295533d95069c14338296e1bff7';

        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=' . $grant_type . '&appid=' . $appid . '&secret=' . $secret;

        $curl = curl_init();
        // 设置请求的URL
        curl_setopt($curl, CURLOPT_URL, $url);
        // 设置头文件的信息作为数据流输出
        // curl_setopt($curl, CURLOPT_HEADER, 1);
        // 设置获取的信息以文件流形式返回，而不是直接输出
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $data = curl_exec($curl);
        curl_close($curl);
        return json_decode($data);
    }

    public function actionArray()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/token';

        $params = [
            'grant_type' => 'client_credential',
            'appid' => 'wx543ed3903a242eb6',
            'secret' => '972d0295533d95069c14338296e1bff7',
        ];

        return $this->get($url, $params);
    }
    
    /**
     * 发送返回格式为JSON的HTTP GET请求
     *
     * @param [String] $url
     * @param [Array] $params
     * @return JSON-Data
     */
    protected function get($url, $params)
    {
        $url = $this->generateUrl($url, $params);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        curl_close($curl);

        return json_decode($data);
    }

    /**
     * 根据参数数组，生成get请求的url
     *
     * @param [String] $url
     * @param [Array] $params
     * @return String
     */
    protected function generateUrl($url, $params)
    {
        foreach ($params as $key => $value) {
            $index = array_search($key, array_keys($params));
            if ($index == 0) {
                $url = $url . '?' . $key . '=' . $value;
            } else {
                $url = $url . '&' . $key . '=' . $value;
            }
        }

        return $url;
    }
}
