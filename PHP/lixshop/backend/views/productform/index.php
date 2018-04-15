<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'spu',
            'sku',
            'score',
            //'status',
            //'min_sales_qty',
            //'is_in_stock',
            //'visibility',
            //'url_key:url',
            //'stock',
            //'price',
            //'cost_price',
            //'final_price',
            //'meta_title',
            //'meta_keywords',
            //'meta_description:ntext',
            //'package_number',
            //'created_user_id',
            //'reviw_rate_star_average',
            //'review_count',
            //'favorite_count',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

            <!-- [
                'attribute' => 'image',
                'label' => '图片',
                'format' => 'html',
                'content' => function ($data) {
                    $url = Yii::getAlias('@baseurl').'/backend/web'. $data['image'][0];
                    return Html::img($url, ['alt'=>'yii','width'=>'120','height'=>'120']);
                }
            ], -->
