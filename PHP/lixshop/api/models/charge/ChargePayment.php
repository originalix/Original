<?php

namespace api\models\charge;

use Yii;
use yii\base\Model;
use common\models\Customer;
use common\models\BalanceLog;
use yii\web\HttpException;
use yii\db\Exception;

class ChargePayment extends Model
{
    public $total_fee;

    public function rules()
    {
        return [
            [['total_fee'], 'number'],
        ];
    }

    /**
     * 使用余额直接扣差价的main函数
     *
     * @return void
     */
    public function main()
    {
        if (! $this->validate()) {
            throw new HttpException(418, array_values($this->getFirstErrors())[0]);
        }

        $customer = Customer::findOne(Yii::$app->user->identity->id);
        if ($this->total_fee > $customer->charge) {
            throw new HttpException(420, '余额不足，请选择其他方式支付');
        }

        $customer->charge -= $this->total_fee;

        // 当余额少于30的时候 调整折扣回到100
        if ($customer->charge <= 30.00) {
            $customer->discount = 100;
        }
        
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (! $customer->save()) {
                throw new HttpException(421, array_values($customer->getFirstErrors())[0]);
            }

            $this->writeLog($customer, $this->total_fee);

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw new HttpException(421, $e->getMessage()); 
        }
        
        return $customer;
    }

    /**
     *  余额消费之后，记录消费日志
     */
    function writeLog($customer, $real_amount)
    {
        $log = new BalanceLog();
        $log->customer_id = $customer->id;
        $log->type = 1;
        $log->amount = $real_amount;
        $log->mark = '余额补差价 消费'.$real_amount.'元';
        $log->balance = $customer->charge;
        $log->save();
        
        if (intval($real_amount) < 1) {
            return;
        }
    }
}
