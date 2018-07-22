<?php

namespace api\models\charge;

use Yii;
use yii\base\Model;
use common\models\Customer;
use api\models\order\Order;
use common\models\BalanceLog;
use common\models\CreditLog;
use yii\web\HttpException;
use yii\db\Exception;
use api\models\Mail;

class ChargePay extends Model
{
    public $trade_no;
    public $total_fee;
    
    public function rules()
    {
        return [
            [['trade_no'], 'string', 'max' => 32],
            [['total_fee'], 'number'],
        ];
    }

    /**
     *  使用余额支付的main函数
     */
    public function main()
    {
        if (! $this->validate()) {
            throw new HttpException(418, array_values($this->getFirstErrors())[0]);
        }

        // print_r($this->trade_no);
        // print_r(Yii::$app->user->identity->id);
        // exit;

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

            $this->writeLog($customer, $order->real_amount);

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new HttpException(421, $e->getMessage()); 
        }

        // 完成订单，发送邮件推送
        $mail = new Mail();
        $mail->order_id = $order->id;
        $mail->sendOrderMessage();

        return $order->attributes;
    }

    /**
     *  余额消费之后，记录消费日志
     */
    function writeLog($customer, $real_amount)
    {
        // $customer = Customer::findOne($customer_id);
        $customer = $this->calculateCredit($customer, $real_amount);
        $customer->save();

        $log = new BalanceLog();
        $log->customer_id = $customer->id;
        $log->type = 1;
        $log->amount = $real_amount;
        $log->mark = '余额支付 消费'.$real_amount.'元';
        $log->balance = $customer->charge;
        $log->save();
        
        if (intval($real_amount) < 1) {
            return;
        }

        $credit_log = new CreditLog();
        $credit_log->customer_id = $customer->id;
        $credit_log->type = 1;
        $credit_log->amount = intval($real_amount);
        $credit_log->mark = '获取'.$credit_log->amount.'元';
        $credit_log->balance = $customer->credit;
        $credit_log->save();
    }

    /**
     * 计算用户积分
     */
    protected function calculateCredit($customer, $real_amount)
    {
        $credit = intval($real_amount);
        if ($credit < 1) {
            return $customer;
        }
        $customer->credit += $credit;
        return $customer;
    }
}

