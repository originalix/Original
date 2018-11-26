<?php

namespace api\models;

use Yii;
use yii\base\Model;
use yii\web\HttpException;
use api\models\order\OrderSearch;
use common\models\Appointment;
use common\models\Attachment;
use yii\data\ActiveDataProvider;
use common\models\Customer;

class Mail extends Model
{
    public $order_id;
    public $appointment_id;

    public function sendOrderMessage()
    {
        if (is_null($this->order_id)) {
            return;
        }
        $order = OrderSearch::findOne($this->order_id);
        $address = $order->userName . " " . $order->city . $order->county . $order->street;
        $tel = " 电话: " . $order->tel_number;

        $customer = Customer::findOne($order->customer_id);

        //controller代码 
        $mail = Yii::$app->mailer->compose('@app/mail/order', ['order' => $order, 'customer' => $customer]) 
            ->setTo('1916555871@qq.com') 
            // ->setTo('77252102@qq.com')
            ->setSubject('新订单通知 ' . $address . " 价格： " . $order->real_amount . "元" . $tel) 
            ->send(); 
        return $order;
    }

    public function sendAppointmentMessage()
    {
        if (is_null($this->appointment_id)) {
            Yii::warning('团购预约返回，没有传入appointment_id');
            return;
        }

        Yii::warning('团购预约邮件发送开始，appointment_id: ' . $this->appointment_id . ' ! 发送人id: ' . Yii::$app->user->identity->id);
        $appointment = Appointment::findOne($this->appointment_id);
        $address = $appointment->userName . " " . $appointment->city . $appointment->county . $appointment->street;
        $tel = " 电话: " . $appointment->tel_number;
        //controller代码 
        $mail = Yii::$app->mailer->compose('@app/mail/appointment', ['appointment' => $appointment]);
        $mail->setTo('1916555871@qq.com');
        // $mail->setTo('77252102@qq.com');
        $mail->setSubject('新团购预约 ' . $address . $tel);
        if ($appointment->enter_type == 2) {
            foreach ($appointment->images as $img) {
                $mail->attach($img['url']);
            }
        }
        $mail->send();
        return $appointment;
    }

    public function sendChargePayMail($customer_id, $real_amount)
    {
        $customer = Customer::findOne($customer_id);

        $mail = Yii::$app->mailer->compose('@app/mail/chargepay', ['customer' => $customer, 'real_amount' => $real_amount]) 
            ->setTo('1916555871@qq.com')
            // ->setTo('77252102@qq.com')
            ->setSubject("余额补差价通知, 价格： " . $real_amount . "元" . " 姓名：" . $customer->name . "，用户id: " . $customer->id) 
            ->send(); 
        return $customer;
    }
}
