<?php

namespace api\models;

use Yii;
use yii\base\Model;
use yii\web\HttpException;
use api\models\order\Order;

class Mail extends Model
{
    public $order_id;

    public function sendOrderMessage()
    {
        if (is_null($this->order_id)) {
            return;
        }
        $order = Order::findOne($this->order_id);
        $address = $order->userName . " " . $order->city . $order->county . $order->street;
        $tel = " 电话: " . $order->tel_number;

        //controller代码 
        $mail = Yii::$app->mailer->compose('@app/mail/order', ['order' => $order]) 
            ->setTo('77252102@qq.com') 
            ->setSubject('新订单通知 ' . $address . " 价格： " . $order->real_amount . "元" . $tel) 
            ->send(); 
        return $order;
    }
}
