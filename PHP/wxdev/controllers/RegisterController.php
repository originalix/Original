<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\AdminUser;

class RegisterController extends Controller
{
    public function actionIndex()
    {
        $this->layout = false;
        $model = new AdminUser;

        if (Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                              
            } else {
                $errors = $model->errors;
            }
        }

        return $this->render('//account/register', [
            'model' => $model,
        ]);
    }
}
