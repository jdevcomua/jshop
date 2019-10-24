<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */

$this->title = Yii::t('app','Create Slider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-create">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>