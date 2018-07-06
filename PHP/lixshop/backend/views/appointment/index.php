<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AppointmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Appointments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appointment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Appointment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'platform',
            [
                'attribute' => 'enter_type',
                'label' => '输入方式，1-手动输入，2-上传截图',
                'format' => 'html',
                'content' => function ($data) {
                    switch ($data->enter_type)
                    {
                        case 1:
                            return '手动输入';
                            break;
                        case 2:
                            return '上传截图';
                            break;
                    }
                }
            ],
            'code',
            [
                'attribute' => 'images',
                'label' => '图片',
                'format' => 'html',
                'content' => function ($data) {
                    if (count($data->images) < 1) {
                        return '未上传图片';
                    }
                    $url = $data->images[0]->url;
                    return Html::img($url, ['alt'=>'yii','width'=>'120','height'=>'120']);
                }
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
            
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
