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
        $model = new AdminUser();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            var_dump(Yii::$app->request->post());
        }

        return $this->render('//account/register', [
            'model' => $model,
        ]);
    }
}
