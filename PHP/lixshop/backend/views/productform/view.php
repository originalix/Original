<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view tabbable tab-content no-border padding-24">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改信息', ['product/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除产品', ['delete', 'id' => $model->id], [
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
            'name',
            'spu',
            'sku',
            'score',
            'status',
            'image' => [
                'attribute'=>'image',
                'label' => '图片',
                'value'=> function ($model) {
                    $content = "";
                    if (count($model->image) < 1) {
                        return "没有上传照片";
                    }
                    foreach ($model->image as $imageModel) {
                        $content = $content . Html::img(Yii::getAlias('@baseurl').'/backend/web'. $imageModel->path, ['width'=>'150', 'height'=>'150']);
                    }
                    return $content;
                },
                
                'format' => 'raw',
            ],
            [
                'attribute' => 'flatStock',
                'label' => '库存',
                'value' => function ($data) {
                    return $data->flatStock['stock'];
                }
            ],
            'min_sales_qty',
            'is_in_stock',
            'visibility',
            'url_key:url',
            // 'stock',
            'price',
            'cost_price',
            'final_price',
            'meta_title',
            'meta_keywords',
            'meta_description:ntext',
            'package_number',
            'created_user_id',
            'reviw_rate_star_average',
            'review_count',
            'favorite_count',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
