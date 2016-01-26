<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Kit */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Kit',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="kit-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model, 'arrayItems' => $arrayItems, 'selected' => $selected
    ]) ?>

</div>
