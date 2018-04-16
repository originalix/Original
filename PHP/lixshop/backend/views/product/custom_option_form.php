<?php

/* @var $this yii\web\View */
// use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>

<h5>宝贝销售规格</h5>
<p>该类目下：请填写宝贝规格和库存数量；库存数量为0的宝贝规格，在商品详情页不展示</p>
<div class="space-5"></div>
<?php Pjax::begin();?>
<?=Html::beginForm(['product/pjax'], 'post', ['data-pjax' => '', 'class' => 'form-inline']);?>
<p>批量填充</p>
<?=Html::input('text', 'custom_option_key', Yii::$app->request->post('custom_option_key'), ['class' => 'col-sm-2', 'placeholder' => "宝贝规格"])?>
<?=Html::input('text', 'stock', Yii::$app->request->post('stock'), ['class' => 'col-sm-2', 'placeholder' => "宝贝数量"])?>
<?=Html::hiddenInput('product_id', $product_id);?>

<?=Html::submitButton('新增', ['class' => 'btn btn-primary btn-sm', 'name' => 'submit-button'])?>
<?=Html::endForm()?>
<div class="space-10"></div>
<div class="col-sm-4 col-md-4">
    <div class="">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thin-border-bottom">
                <tr>
                    <th class="">
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
