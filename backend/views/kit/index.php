<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\KitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Комплекты');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kit-index">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <p>
                <?= Html::a(Yii::t('app', 'Создать комплект'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>

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
                        'checkboxOptions' => function ($model, $key, $index, $column) {
                            return ['value' => $model->id];
                        },
                        'header' => HTML::tag('span',null,['class'=>'glyphicon glyphicon-alert','title'=>Yii::t('app','For delete or edit')]),
                    ],
                    'id',
                    'title',
                    'description:ntext',
                    'cost',

                    ['class' => 'yii\grid\ActionColumn',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            return Yii::$app->urlHelper->to(['kit/' . $action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]);

            echo Html::submitButton('Удалить', ['class' => 'btn btn-danger',]);
            echo Html::endForm(); ?>
        </div>
    </div>
</div>
