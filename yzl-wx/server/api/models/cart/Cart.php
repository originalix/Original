<?php

namespace api\models\cart;

use Yii;
use common\models\SalesFlatCart;
use common\models\Customer;
use yii\web\HttpException;

class Cart extends SalesFlatCart
{
    public static function createRow()
    {
        if (is_null($this->items_count)) {
            $this->items_count = 0;
        }
        $identity = Yii::$app->user->identity;
        if (is_null($identity)) {
            $this->customer_id = NULL;
            $this->customer_is_guest = false;
        } else {
            $this->customer_id = $identity->id;
            $this->customer_is_guest = true;    
        }
        $this->customer_name = NULL;
        $this->remote_ip = Yii::$app->request->userIP;

        if (! $this->save()) {
            throw new HttpException(418, '创建购物车失败');
        }

        return $this;
    }

    public static function findByCustomerId($id)
    {
        return static::find()->where(['customer_id' => $id])->one();
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
