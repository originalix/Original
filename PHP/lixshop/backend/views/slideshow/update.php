<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SlideShow */

$this->title = 'Update Slide Show: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Slide Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="slide-show-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
