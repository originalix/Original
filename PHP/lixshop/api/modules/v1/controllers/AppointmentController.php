<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use common\models\Customer;
use yii\web\HttpException;
use common\models\Appointment;
use api\models\AppointmentForm;

class AppointmentController extends BaseController
{
    public function actionCreate()
    {
        $model = new AppointmentForm();
        if (! $model->load(Yii::$app->request->post(), '')) {
            throw new HttpException(419, '输入数据错误，请重试');
        }

        return $model->saveItem();
    }

    public function actionView($id)
    {
        $model = Appointment::findOne($id);
        if (is_null($model)) {
            throw new HttpException(419, '没有数据');
        }

        return $model;
    }
}

