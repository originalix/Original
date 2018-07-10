<?php

namespace api\queues;

use Yii;
use yii\base\BaseObject;
use api\models\Mail;

class SendMailJob extends BaseObject implements \yii\queue\JobInterface
{
    public $order_id;

    public function execute($queue)
    {
        print_r(['msg' => '开始调用邮件队列']);
        print_r(['msg' => '为什么没有order——id']);

        $model = new Mail();
        $model->send();
    }
}
