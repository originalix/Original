<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use common\widgets\imgupload\ImgMultUpload;  
use kartik\file\FileInput;  
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

$this->title = '添加商品';
?>

<div class="page-header">
    <h1>
        商品管理
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            添加商品
        </small>
    </h1>
</div>
<!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div class="tabbable">
            <div class="tab-content no-border padding-24">
                <?php $form = ActiveForm::begin([
                    'id' => 'form-category',           
                ]); ?>

                <h3 class="row header smaller lighter blue">
                   
                    <span class="col-sm-7">
                        <i class="ace-icon fa fa-magic"></i>
                        分类信息
                    </span><!-- /.col -->
                    <?= Html::submitButton('保存', [
                        'class'=>'btn btn-white btn-info btn-bold pull-right',
                        'name' =>'submit-button',
                    ])?>
                </h3>

                <?php
                    $dataSource = [];
                    foreach($category_models as $category_model) {
                        $dataSource[strval($category_model->id)] = $category_model->category;
                    }
                ?>

                <?= $form->field($category, 'category[]')->label('')->checkboxList($dataSource); ?>
                <?php ActiveForm::end(); ?>

                <?= $this->render('custom_option_form',[
                    'models' => $models,
                    'product_id' => $id,
                ]); ?>
            </div>
        </div>
        <!-- PAGE CONTENT ENDS -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
