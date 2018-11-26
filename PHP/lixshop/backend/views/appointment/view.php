<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Appointment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Appointments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appointment-view">

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
            'platform',
            'enter_type',
            'code',
            'image' => [
                'attribute'=>'image',
                'label' => '上传截图',
                'value'=> function ($model) {
                    $content = "";
                    if (count($model->images) < 1) {
                        return "没有上传照片";
                    }
                    foreach ($model->images as $imageModel) {
                        $content = $content . Html::img($imageModel->url, ['width'=>'750', 'height'=>'1334']);
                    }
                    return $content;
                },
                
                'format' => 'raw',
            ],
            'clothes_count',
            'userName',
            'province',
            'city',
            'county',
            'street',
            'postal_code',
            'tel_number',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
