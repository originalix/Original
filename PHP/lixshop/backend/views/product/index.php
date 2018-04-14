<?php  
  
/* @var $this yii\web\View */  
  
use common\widgets\imgupload\ImgMultUpload;  
use kartik\file\FileInput;  
use yii\helpers\Html;  
use yii\bootstrap\ActiveForm;  
use yii\helpers\Url;
  
$this->title = 'test';  
  
?>  
  
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
	],
	'id' => 'form-image',  
]); ?>  
  
<?= ImgMultUpload::widget(['label' => '产品图片', 'imgarr' => [  

], 'imagedir' => '/uploads/temp/']); ?>  

<?= Html::submitButton('登录', [
                                        'class'=>'width-35 pull-right btn btn-sm btn-primary',
                                        'name' =>'submit-button',
                                        'template' => '<i class="ace-icon fa fa-key"></i>'
                                        ])?>
<?php 
ActiveForm::end();  
?>
