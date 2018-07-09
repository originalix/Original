<?php

namespace api\queues;

use Yii;
use yii\base\BaseObject;

class SendMailJob extends BaseObject implements \yii\queue\JobInterface
{
    public $order_id;

    public function execute($queue)
    {

    }
}
