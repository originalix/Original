<?php

namespace api\utils;

class Curl
{
    private $ch;
    private $url;

    public function __construct()
    {
        $this->ch = curl_init();
    }
    
    /**
     *  设置一个请求链接
     *  @param String $url 请求的地址
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
    
    /**
     *  设置请求属性
     *  @param boolean $isHttps     是否采用https方式请求
     *  @param string $requestType  请求方式
     */
    private function setopt($isHttps, $rquestType, $data, $useCert = false)
    {
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_HEADER, 0);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        if ($isHttps) {
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 2);
        }

        if ($useCert == true) {
            curl_setopt($this->ch, CURLOPT_SSLCERTTYPE, 'PEM');
            curl_setopt($this->ch, CURLOPT_SSLCERT, SSLCERT_PATH);
            curl_setopt($this->ch, CURLOPT_SSLKEYTYPE, 'PEM');
            curl_setopt($this->ch, CURLOPT_SSLKEY, SSLKEY_PATH);
        }

        if (!empty($data)) {
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
        }

        if ($requestType == 'POST') {
            curl_setopt($this->ch, CURLOPT_POST, true);
        }
    }
}

