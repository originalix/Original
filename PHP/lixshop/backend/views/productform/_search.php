<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\mongodb\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, '_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'spu') ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'min_sales_qty') ?>

    <?php // echo $form->field($model, 'is_in_stock') ?>

    <?php // echo $form->field($model, 'visibility') ?>

    <?php // echo $form->field($model, 'url_key') ?>

    <?php // echo $form->field($model, 'stock') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'cost_price') ?>

    <?php // echo $form->field($model, 'final_price') ?>

    <?php // echo $form->field($model, 'meta_title') ?>

    <?php // echo $form->field($model, 'meta_keywords') ?>

    <?php // echo $form->field($model, 'meta_description') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'short_description') ?>

    <?php // echo $form->field($model, 'custom_option') ?>

    <?php // echo $form->field($model, 'package_number') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_user_id') ?>

    <?php // echo $form->field($model, 'attr_group') ?>

    <?php // echo $form->field($model, 'reviw_rate_star_average') ?>

    <?php // echo $form->field($model, 'review_count') ?>

    <?php // echo $form->field($model, 'reviw_rate_star_info') ?>

    <?php // echo $form->field($model, 'favorite_count') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
