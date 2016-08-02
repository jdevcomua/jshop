<?php

use common\models\Vote;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\VoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $notChecked yii\data\ActiveDataProvider */
/* @var $hidden \yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Votes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vote-index">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab"><?= \Yii::t('app', 'Все отзывы'); ?></a></li>
            <li><a href="#tab_2" data-toggle="tab"><?= \Yii::t('app', 'Ожидают проверки'); ?></a></li>
            <li><a href="#tab_3" data-toggle="tab"><?= \Yii::t('app', 'Скрытые'); ?></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        [
                            'attribute' => 'itemTitle',
                            'value' => function($data){
                                return Html::a(Html::encode($data->itemTitle), Yii::$app->urlHelper->to(['item/view','id'=>$data->item->id]));
                            },
                            'format' => 'raw',
                        ],
                        //'user_id',
                        'timestamp',
                        'text:ntext',
                        'rating',
                        [
                            'attribute' => 'checked',
                            'value' => function($data){
                                switch($data->checked){
                                    case Vote::STATUS_NOT_CHECKED: return 'Не проверен';
                                    case Vote::STATUS_HIDDEN: return 'Скрыт';
                                    case Vote::STATUS_CHECKED: return 'Одобрен';
                                    default; return 'Не проверен';
                                }
                            },
                            'filter' => [
                                Vote::STATUS_NOT_CHECKED => 'Не проверен',
                                Vote::STATUS_CHECKED => 'Одобрен',
                                Vote::STATUS_HIDDEN => 'Скрыт'
                            ]
                        ],

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                <?php echo Html::beginForm(['group'], 'post');
                echo GridView::widget([
                    'dataProvider' => $notChecked,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'class' => 'yii\grid\CheckboxColumn',
                            'name' => 'id',
                            // you may configure additional properties here
                            'checkboxOptions' => function ($model, $key, $index, $column) {
                                return ['value' => $model->id];
                            }
                        ],
                        //'id',
                        [
                            'attribute' => 'itemTitle',
                            'value' => function($data){
                                return Html::a(Html::encode($data->itemTitle), Yii::$app->urlHelper->to(['item/view','id'=>$data->item->id]));
                            },
                            'format' => 'raw',
                        ],
                        //'user_id',
                        'timestamp',
                        'text:ntext',
                        'rating',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                echo Html::submitButton(Yii::t('app', 'Одобрить'), ['class' => 'btn btn-success', 'name' => 'action', 'value' => Vote::STATUS_CHECKED]) . ' ';
                echo Html::submitButton(Yii::t('app', 'Скрыть'), ['class' => 'btn btn-warning', 'name' => 'action', 'value' => Vote::STATUS_HIDDEN]);
                echo Html::endForm(); ?>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
                <?= GridView::widget([
                    'dataProvider' => $hidden,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        [
                            'attribute' => 'itemTitle',
                            'value' => function($data){
                                return Html::a(Html::encode($data->itemTitle), Yii::$app->urlHelper->to(['item/view','id'=>$data->item->id]));
                            },
                            'format' => 'raw',
                        ],
                        //'user_id',
                        'timestamp',
                        'text:ntext',
                        'rating',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
</div>
