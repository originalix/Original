<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CouponSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coupon-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_person') ?>

    <?= $form->field($model, 'coupon_name') ?>

    <?= $form->field($model, 'coupon_description') ?>

    <?= $form->field($model, 'coupon_code') ?>

    <?php // echo $form->field($model, 'expiration_date') ?>

    <?php // echo $form->field($model, 'users_per_customer') ?>

    <?php // echo $form->field($model, 'times_used') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'conditions') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
