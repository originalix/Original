<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class BaseController extends \yii\web\Controller
{
    public $layout = "home.php";

    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update'],
                'rules' => [
                    // 允许认证用户
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // 默认禁止其他用户
                ],       
            ],
            'verbs' => [
                'class' => VerbFilter:: className(),
                'actions' => [
                     'index'  => [ 'get'],            //只允许get方式访问
                 ],
            ],
        ];
    }
}
