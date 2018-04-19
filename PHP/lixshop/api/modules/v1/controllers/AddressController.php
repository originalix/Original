<?php

namespace api\modules\v1\controllers;

use Yii;
use api\components\BaseController;
use yii\web\HttpException;

class AddressController extends BaseController
{
    public $modelClass = 'api\models\customer\Address';

    /**
     * 获取地址列表
     *
     * @return void
     */
    public function actionIndex()
    {
        $modelClass = new $this->modelClass;
        return $modelClass->getList();
    }

    /**
     * 创建地址
     *
     * @return void
     */
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

    /**
     * 根据地址id 查看地址
     *
     * @return void
     */
    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $modelClass = new $this->modelClass;
        $address = $modelClass->getAddress($id);
        if (is_null($address)) {
            throw new HttpException(418, '没有查找到地址信息');
        }

        return $address;
    }

    public function actionUpdate()
    {
        $request = Yii::$app->request;
        $data = $request->getBodyParams();
        $modelClass = new $this->modelClass;
        // $modelClass->id = $request->post('id');
        return $modelClass->updateAddress($data);

        // $modelClass->customer_id = Yii::$app->user->identity->id;
        // $modelClass->name = $request->post('name');
        // $modelClass->telephone = $request->post('telephone');
        // $modelClass->province = $request->post('province');
        // $modelClass->city = $request->post('city');
        // $modelClass->district = $request->post('district');
        // $modelClass->street = $request->post('street');
        // $modelClass->is_default = is_null($request->post('is_default')) ? 0 : $request->post('is_default');
    }

    public function actionDelete()
    {

    }
}
