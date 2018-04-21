<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SlideShow */

$this->title = 'Create Slide Show';
$this->params['breadcrumbs'][] = ['label' => 'Slide Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slide-show-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
