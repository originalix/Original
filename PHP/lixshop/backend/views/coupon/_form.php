<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Coupon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coupon-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coupon_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coupon_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'coupon_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expiration_date')->textInput() ?>

    <?= $form->field($model, 'users_per_customer')->textInput() ?>

    <?= $form->field($model, 'times_used')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'conditions')->textInput() ?>

    <?= $form->field($model, 'discount')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
