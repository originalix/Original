<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CouponUsage */

$this->title = 'Update Coupon Usage: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Coupon Usages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="coupon-usage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
