<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SeoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Letters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-index">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::encode($this->title) ?>
            </h3>
        </div>
        <div class="box-body">
            <?php echo Html::beginForm(['del'], 'post');?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'name' => 'id',
                        // you may configure additional properties here
                        'checkboxOptions' => function ($model) {
                            return ['value' => $model->id];
                        },
                        'header' => HTML::tag('span',null,['class'=>'glyphicon glyphicon-alert','title'=>Yii::t('app','For delete or edit')]),
                    ],
                    'id',
                    'email',
                    'name',
                    'order_id',
                    'phone',
                    'letter',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'visibleButtons' =>
                            [
                                'update' => Yii::$app->user->can('updatePost'),
                            ]
                    ]
                ],
            ]);
            echo Html::submitButton(Yii::t('app', 'Удалить'), ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'del']);
            echo Html::endForm();
            ?>
        </div>
    </div>
</div>
