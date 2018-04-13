<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use common\widgets\imgupload\ImgMultUpload;  
use kartik\file\FileInput;  
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

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
            <ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#faq-tab-1">
                        <i class="blue ace-icon fa fa-question-circle bigger-120"></i>
                        基本信息
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#faq-tab-2">
                        <i class="green ace-icon fa fa-user bigger-120"></i>
                        描述信息
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#faq-tab-3">
                        <i class="orange ace-icon fa fa-credit-card bigger-120"></i>
                        上传封面图
                    </a>
                </li>

                <li>
                    <a data-toggle="tab" href="#faq-tab-4">
                        <i class="purple ace-icon fa fa-magic bigger-120"></i>
                        分类信息
                    </a>
                </li>
                <!-- /.dropdown -->
            </ul>
            <?php
                $model->name = "斯伯丁篮球";
            ?>
            <div class="tab-content no-border padding-24">
                <div id="faq-tab-1" class="tab-pane fade in active">
                    <?php $form = ActiveForm::begin(['id' => 'form-product']); ?>
                        <?= $form->field($model, 'name')->textInput()->label('产品名称') ?>
                        <?= $form->field($model, 'cost_price')->textInput()->label('成本价格') ?>
                        <?= $form->field($model, 'final_price')->textInput()->label('销售价格') ?>
                        <?= $form->field($model, 'spu')->textInput()->label('标准化产品单元') ?>
                        <?= $form->field($model, 'sku')->textInput()->label('库存量单位') ?>
                        <?= $form->field($model, 'stock')->textInput()->label('库存个数') ?>
                        <?= $form->field($model, 'package_number')->textInput()->label('打包销售个数') ?>
                        <?= $form->field($model, 'min_sales_qty')->textInput()->label('最小购买数') ?>
                        <?= $form->field($model, 'is_in_stock')->dropDownList(
                            ['1'=>'有货','0'=>'无货']
                        ) ?>
        
                    <?php ActiveForm::end(); ?>
                </div>

                <div id="faq-tab-2" class="tab-pane fade">
                    <?php $form = ActiveForm::begin(['id' => 'form-product']); ?>
                        <?= $form->field($model, 'meta_title')->textInput()->label('展示标题') ?>
                        <?= $form->field($model, 'meta_keywords')->textInput()->label('关键字') ?>
                        
                        <?= $form->field($model, 'meta_description')->widget(\yii\redactor\widgets\Redactor::className(),[
                            'clientOptions' => [
                                'lang' => 'zh_cn',
                            ]
                        ]) ?>
        
                    <?php ActiveForm::end(); ?>
                </div>
                <div id="faq-tab-3" class="tab-pane fade">
                    <?php $form = ActiveForm::begin([  
                        'layout' => 'horizontal',  
                        'enableAjaxValidation' => false,  
                        'method' => 'post',  
                        'options' => ['enctype' => 'multipart/form-data'],  
                        'fieldConfig' => [  
                            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{endWrapper}",  
                            'horizontalCssClasses' => [  
                                'label' => 'col-lg-2',  
                                'wrapper' => 'col-lg-6',  
                                'error' => 'col-lg-3',  
                                'hint' => '',  
                            ],  
                        ]  
                    ]); ?>  
                    
                    <?= ImgMultUpload::widget(['label' => '产品图片', 'imgarr' => [  
                    ], 'imagedir' => '/uploads/temp/']); ?>  
                    <?php  
                    ActiveForm::end();  
                    ?> 
                </div>
                <div id="faq-tab-4" class="tab-pane fade">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="widget-box widget-color-blue2">
                                <div class="widget-header">
                                    <h4 class="widget-title lighter smaller">Choose Categories</h4>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main padding-8">
                                        <ul id="tree1"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- PAGE CONTENT ENDS -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<?= $this->render('category_script'); ?>
