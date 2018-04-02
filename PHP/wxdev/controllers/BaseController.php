<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    /**
     * 默认将基类的返回类型定义为JSON格式
     *
     * @param [Event] $action
     * @return void
     */
    // public function beforeAction($action)
    // {
    //     return Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    // }

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }
 
    public function beforeAction($action)
    {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header('Access-Control-Allow-Credentials: true');
        header("Access-Control-Allow-Headers: Authorization,Content-Type,Accept,Origin,User-Agent,DNT,Cache-Control,X-Mx-ReqToken,Keep-Alive,X-Requested-With,If-Modified-Since");
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            \Yii::$app->response->setStatusCode(204);
            \Yii::$app->end(0);
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }
}
