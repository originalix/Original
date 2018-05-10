<?php

namespace wechat\controllers;

use Yii;
use wechat\components\BaseController;
use GuzzleHttp\Client;

class LoginController extends BaseController
{
    public function actionIndex()
    {
        $client = new Client();
		$res = $client->request('GET', 'http://140.143.8.19/code-repo/PHP/lixshop/api/web/test/index');
		$data = json_decode($res->getBody()->getContents());
        return ['data' => $data];
    }
}
