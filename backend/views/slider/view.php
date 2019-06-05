<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sliders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="slider-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        echo Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to(['slider/update', 'id' => $model->id]),
                ['class' => 'btn btn-primary']) . ' ';
        echo Html::a(Yii::t('app', 'Удалить'), Yii::$app->urlHelper->to(['slider/delete', 'id' => $model->id]), [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот предмет?'),
                    'method' => 'post',
                ],
            ]) . ' ';
        echo Html::a(Yii::t('app', 'Создать'), Yii::$app->urlHelper->to(['slider/create']),
                ['class' => 'btn btn-success']) . ' ';
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'largeTitle',
            'description',
            [
                'attribute'=>'image',
                'value'=>$model->getImageUrl(),
                'format'=>['image',['width'=>'300']]
            ],

            'type',
        ],
    ]) ?>


</div>
