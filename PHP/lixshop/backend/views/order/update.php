<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SalesFlatOrder */

$this->title = 'Update Sales Flat Order: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sales Flat Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-flat-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
