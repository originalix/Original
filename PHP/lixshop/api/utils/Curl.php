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

    public function setUrl($url)
    {
        $this->url = $url;
    }
}

