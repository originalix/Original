<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\mongodb\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, '_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'spu') ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'score') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'min_sales_qty') ?>

    <?= $form->field($model, 'is_in_stock') ?>

    <?= $form->field($model, 'visibility') ?>

    <?= $form->field($model, 'url_key') ?>

    <?= $form->field($model, 'stock') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'cost_price') ?>

    <?= $form->field($model, 'final_price') ?>

    <?= $form->field($model, 'meta_title') ?>

    <?= $form->field($model, 'meta_keywords') ?>

    <?= $form->field($model, 'meta_description') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'short_description') ?>

    <?= $form->field($model, 'custom_option') ?>

    <?= $form->field($model, 'package_number') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'created_user_id') ?>

    <?= $form->field($model, 'attr_group') ?>

    <?= $form->field($model, 'reviw_rate_star_average') ?>

    <?= $form->field($model, 'review_count') ?>

    <?= $form->field($model, 'reviw_rate_star_info') ?>

    <?= $form->field($model, 'favorite_count') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
