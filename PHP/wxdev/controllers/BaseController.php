<?php
/*
 * @Author: Lix 
 * @Date: 2018-04-03 06:57:48 
 * @Last Modified by:   Lix 
 * @Last Modified time: 2018-04-03 06:57:48 
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }
    
    /**
     * 添加跨域请求头，返回JSON格式
     *
     * @param [type] $action
     * @return void
     */
    public function beforeAction($action)
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header("Access-Control-Allow-Headers: Authorization,Content-Type,Accept,Origin,User-Agent,DNT,Cache-Control,X-Mx-ReqToken,Keep-Alive,X-Requested-With,If-Modified-Since");
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }
}
