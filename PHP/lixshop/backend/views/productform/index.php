<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '产品信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index tabbable tab-content no-border padding-24">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建产品', ['product/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'meta_title',
            [
                'attribute' => 'image',
                'label' => '图片',
                'format' => 'html',
                'content' => function ($data) {
                    if (count($data->image) < 1) {
                        return '未上传图片';
                    }
                    $url = Yii::getAlias('@baseurl').'/backend/web'. $data->image[0]->path;
                    return Html::img($url, ['alt'=>'yii','width'=>'120','height'=>'120']);
                }
            ],
            [
                'attribute' => 'flatStock',
                'label' => '库存',
                'content' => function ($data) {
                    return $data->flatStock['stock'];
                }
            ],
            'spu',
            'sku',
            'score',
            'status',
            'min_sales_qty',
            'is_in_stock',
            // 'visibility',
            //'url_key:url',
            // 'stock',
            'price',
            'cost_price',
            //'final_price',
            //'meta_keywords',
            //'meta_description:ntext',
            //'package_number',
            //'created_user_id',
            //'reviw_rate_star_average',
            //'review_count',
            //'favorite_count',
            'created_at',
            //'updated_at',

            // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update} {delete}',
                
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url = $model->id;
                        return $url;
                    }
        
                    if ($action === 'update') {
                        $url ='../product/update?id='.$model->id;
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url ='delete?id='.$model->id;
                        return $url;
                    }
                }
            ],
            
        ],
    ]); ?>
</div>
