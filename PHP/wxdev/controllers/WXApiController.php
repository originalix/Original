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
        $url = 'https://api.weixin.qq.com/cgi-bin/token';

        $params = [
            'grant_type' => 'client_credential',
            'appid' => 'wx543ed3903a242eb6',
            'secret' => '972d0295533d95069c14338296e1bff7',
        ];

        $jsonData = $this->get($url, $params);
        return [
            'msg' => '获取微信Access_Token成功',
            'access_token' => $jsonData->access_token,
            'expires_in' => $jsonData->expires_in,
        ];
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
