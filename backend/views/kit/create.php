<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Kit */

$this->title = Yii::t('app', 'Создать комплект');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'arrayItems' => $arrayItems,
    ]) ?>

</div>
