<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\mongodb\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
        // print_r(json_encode($dataProvider));
        // exit();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // '_id',
            'name',
            'meta_title',
            'spu',
            'sku',
            'score',
            'status',
            'min_sales_qty',
            'is_in_stock',
            'visibility',
            'url_key',
            'stock',
            'category',
            'price',
            'cost_price',
            'final_price',
            // 'meta_keywords',
            // 'meta_description',
            // 'image',
            //'description',
            //'short_description',
            //'custom_option',
            //'package_number',
            //'created_at',
            //'updated_at',
            //'created_user_id',
            //'attr_group',
            //'reviw_rate_star_average',
            //'review_count',
            //'reviw_rate_star_info',
            //'favorite_count',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
