<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Item */

$this->title = Yii::t('app', 'Создать предмет');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
