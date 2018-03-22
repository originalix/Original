<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;
use app\models\HttpRequest;

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
        
        $http = new HttpRequest();
        $jsonData = $http->get($url, $params);

        return [
            'msg' => '获取微信Access_Token成功',
            'access_token' => $jsonData->access_token,
            'expires_in' => $jsonData->expires_in,
        ];
    }

}
