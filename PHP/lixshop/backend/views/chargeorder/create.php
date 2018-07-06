<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ChargeOrder */

$this->title = 'Create Charge Order';
$this->params['breadcrumbs'][] = ['label' => 'Charge Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="charge-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
