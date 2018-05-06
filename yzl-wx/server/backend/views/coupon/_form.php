<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Coupon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coupon-form tabbable tab-content no-border padding-24">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'coupon_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coupon_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'coupon_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expiration_date')->widget(DateTimePicker::classname(), [
        'name' => 'Article[created_at]', 
        'options' => ['placeholder' => '请输入优惠券过期时间'], 
        //value值更新的时候需要加上 
        'value' => '2016-05-03', 
        'pluginOptions' => [ 
            'autoclose' => true, 
            'format' => 'yyyy-mm-dd hh:ii:ss',
            'todayHighlight' => true, 
            'language'=>'zh-CN'
        ]
    ]); ?>

    <?= $form->field($model, 'users_per_customer')->textInput() ?>

    <?= $form->field($model, 'times_used')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'conditions')->textInput() ?>

    <?= $form->field($model, 'discount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
