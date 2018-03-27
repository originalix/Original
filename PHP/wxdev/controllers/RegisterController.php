<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\AdminUser;

class RegisterController extends Controller
{
    public function actionIndex()
    {
        $model = new AdminUser();

        $this->layout = false;
        return $this->render('//account/register', [
            'model' => $model,
        ]);
    }
}
