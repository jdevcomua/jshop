<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\common\models\Item */

$this->title = Yii::t('app', 'Создать предмет');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
