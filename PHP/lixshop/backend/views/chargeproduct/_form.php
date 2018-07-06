<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ChargeProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="charge-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'user_discount')->textInput() ?>

    <?= $form->field($model, 'gift')->textInput() ?>

    <?= $form->field($model, 'discount')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
