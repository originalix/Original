<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SlideShowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '首页轮播图管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-show-index tabbable tab-content no-border padding-24">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('选择需要启用的轮播图', ['change'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'path',
                'label' => '图片',
                'format' => 'html',
                'content' => function ($data) {
                    if (is_null($data->path)) {
                        return '未上传图片';
                    }
                    $url = Yii::getAlias('@baseurl').'/backend/web'. $data->path;
                    return Html::img($url, ['alt'=>'yii','width'=>'180','height'=>'120']);
                }
            ],
            [
                'attribute' => 'is_usage',
                'label' => '是否启用',
                'content' => function ($data) {
                    if ($data->is_usage == false) {
                        return '未使用';
                    } else {
                        return '使用中';
                    }
                }
            ],
            // 'is_usage',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
