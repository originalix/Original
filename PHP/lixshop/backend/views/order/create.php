<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SalesFlatOrder */

$this->title = 'Create Sales Flat Order';
$this->params['breadcrumbs'][] = ['label' => 'Sales Flat Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-flat-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
