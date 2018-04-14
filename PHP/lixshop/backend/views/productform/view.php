<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\mongodb\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => (string)$model->_id], [
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
            '_id',
            'name',
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
            'meta_title',
            'meta_keywords',
            'meta_description',
            // 'image',
            [
                'attribute'=>'image',
                'value'=> function ($model) {
                    $content = "";
                    if (count($model->image) < 1) {
                        return "没有上传照片";
                    }
                    foreach ($model->image as $key => $url) {
                        $content = $content . Html::img(Yii::getAlias('@baseurl').'/backend/web'. $model->image[$key], ['width'=>'150', 'height'=>'150']);
                    }
                    return $content;
                    // return Html::img(Yii::getAlias('@baseurl').'/backend/web'. $model->image[0], ['width'=>'150', 'height'=>'150']) . Html::img(Yii::getAlias('@baseurl').'/backend/web'. $model->image[1], ['width'=>'150', 'height'=>'150']);
                },
                
                'format' => 'raw',
            ],

            'description',
            'short_description',
            // 'custom_option',
            'package_number',
            'created_at',
            'updated_at',
            'created_user_id',
            'attr_group',
            'reviw_rate_star_average',
            'review_count',
            'reviw_rate_star_info',
            'favorite_count',
        ],
    ]) ?>

</div>
