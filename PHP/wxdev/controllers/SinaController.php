<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;
use app\models\HttpRequest;

class SinaController extends BaseController
{
    public function actionHome()
    {
        $url = 'https://api.weibo.com/2/statuses/home_timeline.json';

        $params = [
            'access_token' => '2.00LuOaLCdo3qvC1055521a7aoyzyVE',
        ];

        $http = new HttpRequest();
        $data = $http->get($url, $params);
        return $data;
    
    }

    public function actionUser()
    {
        $url = 'https://api.weibo.com/2/statuses/user_timeline.json';

        $params = [
            'access_token' => '2.00LuOaLCdo3qvC1055521a7aoyzyVE',
        ];

        $http = new HttpRequest();
        $data = $http->get($url, $params);
        return $data;
    }
}
