<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'wechat_openid',
            'mobile',
            'name',
            'charge',
            'card_id',
            'credit',
            'discount',
            // 'group',
            // 'favorite_product_count',
            'created_at',
            //'updated_at',
            //'access_token',
            //'access_token_created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
