<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use common\widgets\imgupload\ImgMultUpload;  
use kartik\file\FileInput;  
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = '修改商品信息';
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
                    'id' => 'form-product',
                    'options' => ['enctype' => 'multipart/form-data'], 
                    'enableAjaxValidation' => false,            
                ]); ?>

                <h3 class="row header smaller lighter blue">
                    <span class="col-sm-7">
                        <i class="ace-icon fa fa-question-circle"></i>
                        基本信息
                    </span><!-- /.col -->

                    <?= Html::submitButton('保存修改', [
                        'class'=>'btn btn-white btn-info btn-bold pull-right',
                        'name' =>'submit-button',
                    ])?>
                </h3>

                <!-- 基本信息form -->
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

                <h3 class="row header smaller lighter blue">
                    <span class="col-sm-7">
                        <i class="ace-icon fa fa-user"></i>
                        描述信息
                    </span><!-- /.col -->
                </h3>

                <!-- 描述信息 -->
                <?= $form->field($model, 'meta_title')->textInput()->label('展示标题') ?>
                <?= $form->field($model, 'meta_keywords')->textInput()->label('关键字') ?>
                
                <?= $form->field($model, 'meta_description')->widget(\yii\redactor\widgets\Redactor::className(),[
                    'clientOptions' => [
                        'lang' => 'zh_cn',
                    ]
                ]) ?>

                <h3 class="row header smaller lighter blue">
                    <span class="col-sm-7">
                        <i class="ace-icon fa fa-credit-card"></i>
                        上传封面图
                    </span><!-- /.col -->
                </h3>
                <?php
                    $result = array();
                    // print_r($model->image);
                    // exit();
                    foreach($model->image as $imageModel) {
                        array_push($result, $imageModel->filename);
                    }
                ?>
                <?= ImgMultUpload::widget([
                            'model' => $imgModel,
                            'form' => $form,
                            'attribute' => 'image',
                            'label' => '产品图片', 
                            'imgarr' => $result,
                            'imagedir' => '../uploads/temp/'
                ]); ?> 
                
                <h3 class="row header smaller lighter blue">
                   
                    <span class="col-sm-7">
                        <i class="ace-icon fa fa-magic"></i>
                        分类信息
                    </span><!-- /.col -->
                </h3>

                <?php
                    $dataSource = [];
                    foreach($category_models as $category_model) {
                        $dataSource[strval($category_model->id)] = $category_model->category;
                    }
                ?>

                <?= $form->field($category, 'category[]')->label('')->checkboxList($dataSource, ['value' => $category->category]); ?>

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
