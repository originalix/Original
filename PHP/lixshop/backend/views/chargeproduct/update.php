<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ChargeProduct */

$this->title = 'Update Charge Product: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Charge Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="charge-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
