<?php
// use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\SlideShow */

$this->title = '设置促销商品';
?>

<?= Html::beginForm('', 'post') ?>
    <?= Html::listBox('list', '', ArrayHelper::map($products, 'id', 'name')) ?>
<?= Html::endForm() ?>
