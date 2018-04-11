<?php

namespace backend\controllers;

class AccountController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
}
