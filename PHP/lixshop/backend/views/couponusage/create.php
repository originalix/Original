<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CouponUsage */

$this->title = 'Create Coupon Usage';
$this->params['breadcrumbs'][] = ['label' => 'Coupon Usages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-usage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
