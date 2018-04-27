<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Coupon */

$this->title = 'Update Coupon: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Coupons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="coupon-update tabbable tab-content no-border padding-24">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
