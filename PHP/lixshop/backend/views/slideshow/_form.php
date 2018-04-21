<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SlideShow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slide-show-form tabbable tab-content no-border padding-24">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('标题') ?>

    <?= $form->field($model, 'imageFile')->fileInput()->label('选择图片上传') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
