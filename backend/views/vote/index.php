<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\VoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $notChecked yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Votes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vote-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="left-personal f-s_0">
        <ul style="list-style-type: none;" class="tabs tabs-data">
            <li style="float: left;" class="active" onclick="
                    $('.activeTab').toggleClass('d_n');
                    $('.activeTab').toggleClass('activeTab');
                    $('.active').toggleClass('active');
                    $(this).toggleClass('active');
                    $('#my_data').toggleClass('d_n');
                    $('#my_data').toggleClass('activeTab');">
                <button class="btn-link" data-href="#my_data"
                        data-source="http://active.imagecmsdemo.net/shop/profile/profile_data"><?php echo \Yii::t('app', 'Все отзывы'); ?>
                </button>
            </li>
            <li style="float: left;" class="" onclick="
                    $('.activeTab').toggleClass('d_n');
                    $('.activeTab').toggleClass('activeTab');
                    $('.active').toggleClass('active');
                    $(this).toggleClass('active');
                    $('#change_pass').toggleClass('d_n');
                    $('#change_pass').toggleClass('activeTab');">
                <button class="btn-link" data-href="#change_pass"
                        data-source="http://active.imagecmsdemo.net/shop/profile/profile_change_pass"><?php echo \Yii::t('app', 'Ожидают проверки'); ?>
                </button>
            </li>
            <li style="" class="" onclick="
                    $('.activeTab').toggleClass('d_n');
                    $('.activeTab').toggleClass('activeTab');
                    $('.active').toggleClass('active');
                    $(this).toggleClass('active');
                    $('#history_order').toggleClass('d_n');
                    $('#history_order').toggleClass('activeTab');">
                <button class="btn-link" data-href="#history_order"
                        data-source="http://active.imagecmsdemo.net/shop/profile/profile_history"><?php echo \Yii::t('app', 'Скрытые'); ?>
                </button>
            </li>
        </ul>
        <div class="frame-tabs-ref frame-tabs-profile">
            <div id="my_data" style="display: block;" class="visited activeTab">
                <div class="inside-padd">
                    <?php echo GridView::widget([
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
                                'filter' => ['0' => 'Не проверен', '1' => 'Одобрен', '-1' => 'Скрыт']
                            ],

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>

            </div>
            <div id="change_pass" style="display: block;" class="d_n">
                <div class="inside-padd">
                    <?php
                    echo Html::beginForm(['group'], 'post');
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
                    echo Html::submitButton(Yii::t('app', 'Одобрить'), ['class' => 'btn btn-success', 'name' => 'action', 'value' => '1']) . ' ';
                    echo Html::submitButton(Yii::t('app', 'Скрыть'), ['class' => 'btn btn-warning', 'name' => 'action', 'value' => '-1']);
                    echo Html::endForm();
                    ?>
                </div>
            </div>
            <div id="history_order" style="display: block;" class="d_n">
                <div class="inside-padd">
                    <?php echo GridView::widget([
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
            </div>
        </div>
    </div>

</div>
