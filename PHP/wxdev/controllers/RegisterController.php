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
        $tips = "";

        if (Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                if ($model->save()) {
                    $tips = "注册成功";
                    return $this->render('//account/register', [
                        'model' => $model,
                        'tips' => $tips,
                    ]);
                }
            }
        }

        return $this->render('//account/register', [
            'model' => $model,
            'tips' => $tips,
        ]);
    }
}
