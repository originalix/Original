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
    <?php
        $session = Yii::$app->session;
        if ($session->hasFlash('error')) {
            echo '<div class="error">';
            echo '<p class="bg-danger">';
            echo $session->getFlash('error');   
            echo '</p>';
            echo '</div>';
        }
        
    ?>
    <?= Html::beginForm('', 'post') ?>
        <table class="table">
            <tr>
                <td>是否促销</td>
                <td>标题</td>
                <td>图片</td>
            </tr>
            <?php
                $promotion_arr = [];
                foreach ($promotions as $promotion) {
                    array_push($promotion_arr, $promotion->product_id);
                }

                foreach($products as $model) {
                    echo '<tr>';
                    echo '<td>';

                    if (in_array($model->id, $promotion_arr)) {
                        echo '<input type="checkbox" name="id[]" value="' . $model->id . '" checked="checked" />';
                    } else {
                        echo '<input type="checkbox" name="id[]" value="' .$model->id .'" />';
                    }
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
        <div class="form-group">
            <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
        </div>
    <?= Html::endForm() ?>
</div>
