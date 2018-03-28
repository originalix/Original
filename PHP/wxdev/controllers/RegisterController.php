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
            // $model->load(Yii::$app->request->post());
            if ($model->load(\Yii::$app->request->post())) {
                // var_dump(Yii::$app->request->post());
                var_dump('user--->: ' . $model->username);
                var_dump('pass--->: ' . $model->password);
                if ($model->validate()) {
                    var_dump('验证通过');
                } else {
                    $errors = $model->errors;
                    var_dump($errors);
                }
            } else {
                // var_dump('load fail');
            }
        }

        return $this->render('//account/register', [
            'model' => $model,
        ]);
    }
}
