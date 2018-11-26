<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SalePromotion */

$this->title = 'Create Sale Promotion';
$this->params['breadcrumbs'][] = ['label' => 'Sale Promotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-promotion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
