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
        'template' => "<div class='row'>{label}</div>\n{beginWrapper}\n{input}\n{hint}\n{endWrapper}",  
        'horizontalCssClasses' => [  
            // 'label' => 'col-md-8',  
            // 'wrapper' => 'col-md-8',  
        //     'error' => 'col-lg-3',  
        //     'hint' => '',  
        ],  
	],
	'id' => 'form-image',  
]); ?>  
  
<?= ImgMultUpload::widget([
	'model' => $model,
	'form' => $form,
	'attribute' => 'image',
	'label' => '产品图片', 
	'imgarr' => [], 
	'imagedir' => '/uploads/temp/'
	]); ?>  

<?= Html::submitButton('登录', [
                                        'class'=>'width-35 pull-right btn btn-sm btn-primary',
                                        'name' =>'submit-button',
                                        'template' => '<i class="ace-icon fa fa-key"></i>'
                                        ])?>
<?php 
ActiveForm::end();  
?>
