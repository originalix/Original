<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use common\widgets\imgupload\ImgMultUpload;  
use kartik\file\FileInput;  
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Pjax测试';
?>

<h3>宝贝销售规格</h3>
<p>该类目下：请填写宝贝规格和库存数量；库存数量为0的宝贝规格，在商品详情页不展示</p>
<?php Pjax::begin(); ?>
    <?= Html::beginForm(['product/pjax'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
    <p>批量填充</p>
    <?= Html::input('text', 'custom_option_key', Yii::$app->request->post('custom_option_key'), ['class' => 'form-control', 'placeholder' => "宝贝规格"]) ?>
    <?= Html::input('text', 'stock', Yii::$app->request->post('stock'), ['class' => 'form-control', 'placeholder' => "宝贝数量"]) ?>
    <?= Html::hiddenInput('product_id', 0); ?>
    <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
    <?= Html::endForm() ?>
    <h3><?= $stringHash ?></h3>
<?php Pjax::end(); ?>
