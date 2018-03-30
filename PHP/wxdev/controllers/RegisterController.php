<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\AdminUser\AdminUserRegister;

class RegisterController extends Controller
{
    /**
     * 注册页面首页
     *
     * @return View
     */
    public function actionIndex()
    {
        $this->layout = false;
        $model = new AdminUserRegister;

        if (Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                if ($model->save()) {
                    return $this->render('//account/register', [
                        'model' => $model,
                    ]);
                } else {

                }
            }
        }

        return $this->render('//account/register', [
            'model' => $model,
        ]);
    }
}
