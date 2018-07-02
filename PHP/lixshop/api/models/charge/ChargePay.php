<?php

namespace api\models;

use Yii;
use yii\base\Model;
use common\models\Customer;
use api\models\order\Order;

class ChargePay extends Model
{
    public $trade_no;
    public $total_fee;

    public function main()
    {

    }
}
