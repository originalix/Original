<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SalePromotion */

$this->title = 'Update Sale Promotion: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sale Promotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sale-promotion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
