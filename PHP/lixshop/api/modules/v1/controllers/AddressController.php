<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use yii\web\HttpException;

class AddressController extends BaseController
{
    public $modelClass = 'api\models\customer\Address';

    public function actionIndex()
    {

    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $modelClass = new $this->modelClass;
        $modelClass->customer_id = Yii::$app->user->identity->id;
        $modelClass->name = $request->post('name');
        $modelClass->telephone = $request->post('telephone');
        $modelClass->province = $request->post('province');
        $modelClass->city = $request->post('city');
        $modelClass->district = $request->post('district');
        $modelClass->street = $request->post('street');
        $modelClass->is_default = is_null($request->post('is_default')) ? 0 : $request->post('is_default');

        $address = $modelClass->create();

        if (is_null($address)) {
            throw new HttpException(418, '创建地址信息失败');
        }

        if (is_string($address)) {
            throw new HttpException(419, $address);
        }

        return $address;
    }

    public function actionView()
    {

    }

    public function actionUpdate()
    {

    }

    public function actionDelete()
    {

    }
}
