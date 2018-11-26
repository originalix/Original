<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\AdminUser\AdminUserLogin;

class LoginController extends Controller
{
    public function actionIndex()
    {
        $this->layout = false;
        return $this->render('//account/login');
    }
}
