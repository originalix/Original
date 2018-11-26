<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ChargeProduct */

$this->title = 'Create Charge Product';
$this->params['breadcrumbs'][] = ['label' => 'Charge Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charge-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
