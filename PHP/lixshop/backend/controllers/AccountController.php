<?php

namespace backend\controllers;

class AccountController extends \yii\web\Controller
{
    public $layout = 'account';
    
    public function actionIndex()
    {
        return $this->render('index');
    }

}
