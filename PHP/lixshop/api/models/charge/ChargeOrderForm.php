<?php

namespace api\models\charge;

use Yii;
use yii\base\Model;
use yii\web\HttpException;
use yii\db\Exception;
use api\models\charge\ChargeOrder;
use common\models\ChargeProduct;

class ChargeOrderForm extends Model
{
    const CHOOSE_CHARGE_PRODUCT = 1; // 选择商品列表的充值方式
    const INPUT_CHARGE_AMOUNT = 2;  // 手动输入金额的充值方式

    public $type;
    public $input_amount = null;
    public $trade_no;
    public $total_amount = 0;
    public $discount_amount = 0;
    public $real_amount = 0;
    public $customer_id;
    public $customer_group;
    public $remote_ip;
    public $payment_method;

    public function rules()
    {
        return [
            
        ];
    }
}
