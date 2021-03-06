<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="slider-view">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
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
                    [
                        'attribute'=>'type',
                        'value'=>$model->getSliderType(),
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
