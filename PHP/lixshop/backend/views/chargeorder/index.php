<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ChargeOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Charge Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charge-order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Charge Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'trade_no',
            // 'order_status',
            [
                'attribute' => 'order_status',
                'label' => '订单状态，1待付款，2已付款，3已完成',
                'format' => 'html',
                'content' => function ($data) {
                    switch ($data->order_status)
                    {
                        case 1:
                            return '待付款';
                            break;
                        case 2:
                            return '已付款';
                            break;
                        case 3:
                            return '已完成';
                            break;
                    }
                    return $data->order_status;
                }
            ],
            'total_amount',
            // 'discount_amount',
            'real_amount',
            'customer_id',
            //'customer_group',
            //'remote_ip',
            'payment_method',
            //'txn_id',
            'created_at',
            //'updated_at',
            'enjoy_discounts',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
