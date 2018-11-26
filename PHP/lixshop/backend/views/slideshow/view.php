<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SlideShow */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Slide Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-show-view tabbable tab-content no-border padding-24">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'path' => [
                'attribute' => 'path',
                'label' => '图片',
                'format' => 'html',
                'value' => function ($data) {
                    if (is_null($data->path)) {
                        return '未上传图片';
                    }
                    $url = Yii::getAlias('@backendUrl'). $data->path;
                    return Html::img($url, ['alt'=>'yii','width'=>'180','height'=>'120']);
                }
            ],
            'filename',
            'is_usage',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
