<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SalesFlatOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Flat Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-flat-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'increment_id',
            'order_status',
            'items_count',
            'total_amount',
            'discount_amount',
            'real_amount',
            'customer_id',
            'customer_group',
            'customer_name',
            'remote_ip',
            'coupon_code',
            'payment_method',
            'order_remark:ntext',
            'txn_type',
            'txn_id',
            'created_at',
            'updated_at',
            'trade_no',
            'userName',
            'province',
            'city',
            'county',
            'street',
            'postal_code',
            'tel_number',
            'express_amount',
            'express_type',
            'express_date',
            'express_time',
        ],
    ]) ?>

</div>
