<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Баннеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <p>
                <?= Html::a(Yii::t('app', 'Создать баннер'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'imageUrl:image',
                    'url:url',
                    [
                        'attribute' => 'position',
                        'value' => function ($model) {
                            return $model->positionTitle;
                        }
                    ],
                    [
                        'attribute' => 'enable',
                        'value' => function ($model) {
                            return Html::tag('span', $model->enable == 1 ? 'Да' : 'Нет',
                                ['class' => 'label ' . ($model->enable == 1 ? 'label-success' : 'label-danger')]);
                        },
                        'format' => 'raw',
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
