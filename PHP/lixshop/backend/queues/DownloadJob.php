<?php
namespace backend\queues;

use yii\base\BaseObject;
use common\models\CustomOptionStock;

class DownloadJob extends BaseObject implements \yii\queue\JobInterface
{
    public $url;
    public $file;
    
    public function execute($queue)
    {
        $model = new CustomOptionStock();
        $model->product_id = 0;
        $model->custom_option_key = "Lix";
        $model->stock = 566;
        if (! $model->save()) {
            echo "保存失败";
        };
    }
}
