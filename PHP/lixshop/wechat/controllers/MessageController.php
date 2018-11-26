<?php

namespace wechat\controllers;

use Yii;
use wechat\components\BaseController;
use GuzzleHttp\Client;

class MessageController extends BaseController
{
    public function actionIndex()
    {
        $access_token = $this->getAccessToken();

        $client = new Client();
		$res = $client->request('POST', 'https://api.weixin.qq.com/cgi-bin/message/custom/send', [
            'query' => [
                'access_token' => $access_token,
            ],
            'json' => [
                'touser' => 'o5Xyo5fYi8wglGvFzlYCQVoFs4ds',
                'msgtype' => 'text',
                'test' => [
                    'content' => 'hello world'
                ]
            ]
        ]);
        $data = json_decode($res->getBody()->getContents());
        return $data;
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
