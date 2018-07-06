<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ChargeOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Charge Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charge-order-view">

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
            'trade_no',
            'order_status',
            'total_amount',
            'discount_amount',
            'real_amount',
            'customer_id',
            'customer_group',
            'remote_ip',
            'payment_method',
            'txn_id',
            'created_at',
            'updated_at',
            'enjoy_discounts',
        ],
    ]) ?>

</div>
