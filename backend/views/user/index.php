<?php

use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Пользователи');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::encode($this->title) ?>
                <?= Html::a(Yii::t('app', 'Создать пользователя'), Yii::$app->urlHelper->to(['user/create']),
                    ['class' => 'btn btn-success']) ?>
            </h3>
        </div>
        <div class="box-body">
            <?php echo Html::beginForm(['del'], 'post');

            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'name' => 'id',
                        // you may configure additional properties here
                        'checkboxOptions' => function (User $model) {
                            return ['value' => $model->id];
                        },
                        'header' => HTML::tag('span',null,['class'=>'glyphicon glyphicon-alert','title'=>Yii::t('app','For delete or edit')]),
                    ],
                    'id',
                    'email',
                    'name',
                    'created:datetime',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'urlCreator' => function ($action, User $model) {
                            return Yii::$app->urlHelper->to(['user/' . $action, 'id' => $model->id]);
                        },
                        'template' => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}&nbsp;&nbsp;{permissions}',
                        'buttons' => [
                            'permissions' => function ($url) {
                                return Html::a('<span class="glyphicon glyphicon-cog" title="'.Yii::t('app','Settings').'"></span>', $url);
                            },
                        ],
                        'contentOptions' => [
                            'style' => 'width: 100px;',
                        ],
                    ],
                ],
            ]);

            echo Html::submitButton('Удалить', ['class' => 'btn btn-danger',]);
            echo Html::endForm(); ?>
        </div>
    </div>
</div>
