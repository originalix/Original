<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SlideShow */

$this->title = '新建轮播图';
$this->params['breadcrumbs'][] = ['label' => 'Slide Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-show-create tabbable tab-content no-border padding-24">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $models,
    ]) ?>

</div>
