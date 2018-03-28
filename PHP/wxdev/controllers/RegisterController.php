<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\AdminUser;

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
        $model = new AdminUser;

        if (Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                if ($model->save()) {
                    return $this->render('//account/register', [
                        'model' => $model,
                        'tips' => '注册成功',
                    ]);
                } else {
                    $this->error('Sorry, Data save fail!');
                }
            }
        }

        return $this->render('//account/register', [
            'model' => $model,
            'tips' => null,
        ]);
    }
}
