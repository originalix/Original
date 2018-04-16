<?php

/* @var $this yii\web\View */
// use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Pjax测试';
?>

<h3>宝贝销售规格</h3>
<p>该类目下：请填写宝贝规格和库存数量；库存数量为0的宝贝规格，在商品详情页不展示</p>
<div class="space-12"></div>
<?php Pjax::begin();?>
<?=Html::beginForm(['product/pjax'], 'post', ['data-pjax' => '', 'class' => 'form-inline']);?>
<p>批量填充</p>
<?=Html::input('text', 'custom_option_key', Yii::$app->request->post('custom_option_key'), ['class' => 'form-control', 'placeholder' => "宝贝规格"])?>
<?=Html::input('text', 'stock', Yii::$app->request->post('stock'), ['class' => 'form-control', 'placeholder' => "宝贝数量"])?>
<?=Html::hiddenInput('product_id', 0);?>
<?=Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'submit-button'])?>
<?=Html::endForm()?>
<div class="widget-body col-md-3">
    <div class="widget-main no-padding">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thin-border-bottom">
                <tr>
                    <th>
                        宝贝规格
                    </th>

                    <th>
                        库存数量 
                    </th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    foreach($models as $model) {
                        echo '<tr>';
                        echo '<td class="">'. $model->custom_option_key .'</td>';
                        echo '<td>'. $model->stock .'</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php Pjax::end();?>
