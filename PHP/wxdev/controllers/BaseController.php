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
    public function beforeAction($action)
    {
        return Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }    
}
