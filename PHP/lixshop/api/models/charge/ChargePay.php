<?php

namespace api\models;

use Yii;
use yii\base\Model;
use common\models\Customer;
use api\models\order\Order;
use yii\web\HttpException;
use yii\db\Exception;

class ChargePay extends Model
{
    public $trade_no;
    public $total_fee;

    public function main()
    {
        $order = Order::find()
          ->where([
            'trade_no' => $this->trade_no,
            'customer_id' => Yii::$app->user->identity->id,
          ])->one();

        if (is_null($order)) {
            throw new HttpException(418, '找不到该订单');
        }

        if ($order->order_status !== 1) {
            throw new HttpException(419, '订单已经完成支付');
        }

        $customer = Customer::findOne(Yii::$app->user->identity->id);
        if ($order->real_amount > $customer->charge) {
            throw new HttpException(420, '余额不足，请选择其他方式支付');
        }

        $order->order_status = 2;
        $order->payment_method = 'charge';

        $customer->charge -= $order->real_amount;

        $transaction = Yii::$app->db->beginTransaction();

        try {
          if (! $order->save()) {
              throw new HttpException(421, array_values($order->getFirstErrors())[0]);
          } 

          if (! $customer->save()) {
              throw new HttpException(421, array_values($customer->getFirstErrors())[0]);
          }

          $transaction->commit();
        } catch (Exception $e) {
        
        }

    }
}
