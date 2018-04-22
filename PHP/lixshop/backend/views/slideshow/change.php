<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\SlideShow */

$this->title = '选择需要启用的轮播图';
$this->params['breadcrumbs'][] = ['label' => 'Slide Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-show-create tabbable tab-content no-border padding-24">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
        ]); ?>

        <table class="table">
            <tr>
                <td class="active">是否启用</td>
                <td class="success">标题</td>
                <td class="warning">图片</td>
            </tr>
            <?php
                foreach($data as $slideModel) {
                    echo '<tr>';
                    echo '<td class="active">';
                    // echo '';
                    echo Html::checkbox('is_usage',$slideModel->is_usage,['calss'=>'form-control']);
                    echo '</td>';
                    echo '<td class="success">';
                    echo $slideModel->title;
                    echo '</td>';
                    echo '<td class="warning">';
                    // echo '图片';
                    $url = Yii::getAlias('@baseurl').'/backend/web'. $slideModel->path;
                    echo Html::img($url, ['alt'=>'yii','width'=>'300','height'=>'150']);
                    echo '</td>';
                    echo '</tr>';
                }
            ?>
            <!-- <tr>
                <td class="active">
                    否
                </td>
                <td class="success">
        
                </td>
                <td class="warning">
        
                </td>
            </tr> -->
        </table>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
