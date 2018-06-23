<?php

namespace api\models\charge;

use Yii;
use common\models\ChargeProduct;
use yii\data\ActiveDataProvider;

class ChargeProductSearch extends ChargeProduct
{
    public function fields()
    {
        return [
            'id',
            'amount',
            'gift',
            'discount',
            'user_discount'
        ]; 
    }

    public function search()
    {
        return static::find()->all();
    }

    public function mock()
    {
        $model1 = new ChargeProduct();
        $model1->setAttributes([
            'amount' => 2000,
            'gift' => 0,
            'user_discount' => 70
        ], false);
        $model1->save();

        $model2 = new ChargeProduct();
        $model2->setAttributes([
            'amount' => 500,
            'gift' => 0,
            'user_discount' => 85
        ], false);
        $model2->save();

        $model3 = new ChargeProduct();
        $model3->setAttributes([
            'amount' => 1000,
            'gift' => 0,
            'user_discount' => 80
        ], false);
        $model3->save();

        $model4 = new ChargeProduct();
        $model4->setAttributes([
            'amount' => 300,
            'gift' => 0,
            'user_discount' => 90
        ], false);
        $model4->save();

        $model5 = new ChargeProduct();
        $model5->setAttributes([
            'amount' => 5000,
            'gift' => 0,
            'user_discount' => 40
        ], false);
        $model5->save();

        $model6 = new ChargeProduct();
        $model6->setAttributes([
            'amount' => 10000,
            'gift' => 0,
            'user_discount' => 30
        ], false);
        $model6->save();
    }
}
