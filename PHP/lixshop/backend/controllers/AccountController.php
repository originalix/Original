<?php

namespace backend\controllers;

use Yii;
use backend\models\SignupForm;

class AccountController extends \yii\web\Controller
{
    public $layout = 'account';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        // if (!Yii::$app->user->isGuest) {
        //     return $this->goHome();
        // }

        return $this->render('login');
    }

}
