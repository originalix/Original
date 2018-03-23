<?php

namespace app\models;

use Yii;
use yii\base\Model;

class HttpRequest extends Model
{
    /**
     * 发送返回格式为JSON的HTTP GET请求
     *
     * @param [String] $url
     * @param [Array] $params
     * @return JSON-Data
     */
    public function get($url, $params)
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

    public function post($url, $urlParams, $params)
    {
        if (count($urlParams) > 0) {
            $url = $this->generateUrl($url, $urlParams);
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        $data = curl_exec($curl);
        curl_close($curl);
        print_r($data);

        return json_decode($data);
    }
}
