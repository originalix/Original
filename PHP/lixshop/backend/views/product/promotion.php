<?php
// use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\SlideShow */

$this->title = '设置促销商品';
?>
<div class="tabbable tab-content no-border padding-24">

    <?= Html::beginForm('', 'post') ?>
    <table class="table">
                <tr>
                    <td>是否促销</td>
                    <td>标题</td>
                    <td>图片</td>
                </tr>
                <?php
                    foreach($products as $model) {
                        echo '<tr>';
                        echo '<td>';
    
                        // if ($slideModel->is_usage) {
                        //     echo '<input type="checkbox" name="id[]" value="' . $slideModel->id . '" checked="checked" />';
                        // } else {
                        //     echo '<input type="checkbox" name="id[]" value="' .$slideModel->id .'" />';
                        // }
                        echo '<input type="checkbox" />';
                        echo '</td>';
                        echo '<td>';
                        echo $model->name;
                        echo '</td>';
                        echo '<td>';
                        $url = Yii::getAlias('@baseurl').'/backend/web'. $model->image[0]->path;
                        echo Html::img($url, ['alt'=>'yii','width'=>'100','height'=>'50'])
                        ;
                        echo '</td>';
                        echo '</tr>';
                    }
                ?>
            </table>
    <?= Html::endForm() ?>
</div>
