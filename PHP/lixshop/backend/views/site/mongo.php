<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = 'Mongodb-Test';
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?php
            foreach($models as $model) {
                print_r($model->name);
            }
        ?>
    </div>

    <p>
        Mongodb-Test
    </p>
</div>
