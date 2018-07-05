<?php

namespace wechat\controllers;

use Yii;
use wechat\components\BaseController;
use GuzzleHttp\Client;

class MessageController extends BaseController
{
    public function actionIndex()
    {
        return $this->getAccessToken();
    }

    protected function getAccessToken()
    {
        $client = new Client();
		$res = $client->request('GET', 'https://api.weixin.qq.com/cgi-bin/token', [
            'query' => [
                'appid' => 'wx3321acae41983595',
                'secret' => 'eee558d25ae6677587e00a7703cff55f',
                'grant_type' => 'client_credential'
            ],
        ]);
        $data = json_decode($res->getBody()->getContents());
        return $data->access_token;
    }
}
