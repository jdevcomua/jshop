<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SearchLog */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::encode($this->title) ?>
            </h3>
        </div>
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'date',
                    'message',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'visibleButtons' =>
                            [
                                'update' => Yii::$app->user->can('updatePost'),
                                'delete' => Yii::$app->user->can('updatePost')
                            ]
                    ]
                ],
            ]); ?>
        </div>
    </div>
</div>
