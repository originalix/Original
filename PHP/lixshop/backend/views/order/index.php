<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales Flat Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-flat-order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sales Flat Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'trade_no',
            // 'id',
            // 'increment_id',
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
            // 'order_status',
            'items_count',
            'total_amount',
            // 'discount_amount',
            'real_amount',
            'customer_id',
            //'customer_group',
            //'customer_name',
            //'remote_ip',
            //'coupon_code',
            'payment_method',
            'order_remark:ntext',
            //'txn_type',
            //'txn_id',
            'created_at',
            //'updated_at',
            'userName',
            'province',
            'city',
            'county',
            'street',
            // 'postal_code',
            'tel_number',
            'express_amount',
            [
                'attribute' => 'express_type',
                'label' => '配送方式',
                'format' => 'html',
                'content' => function ($data) {
                    switch ($data->express_type)
                    {
                        case 0:
                            return '上门配送';
                            break;
                        case 1:
                            return '到店取送';
                            break;
                    }
                    return $data->order_status;
                }
            ],
            'express_date',
            'express_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
