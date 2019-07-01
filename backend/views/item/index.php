<?php

use yii\helpers\Html;
use \common\models\Item;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $filterByCategories array */

$this->title = Yii::t('app', 'Товары');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::encode($this->title) ?>
                <?= Html::a(Yii::t('app', 'Создать товар'), Yii::$app->urlHelper->to(['item/create']), ['class' => 'btn btn-success']) ?>
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
                        'checkboxOptions' => function ($model, $key, $index, $column) {
                            return ['value' => $model->id];
                        }
                    ],
                    'id',
                    'title',
                    'updated_at',
                    [
                        'attribute' => 'cost',
                        'filter' => Html::activeTextInput($searchModel, 'cost', ['placeholder' => 'меньче чем ...']),
                    ],
                    [
                        'attribute' => 'count_of_views',
                        'filter' => Html::activeTextInput($searchModel, 'count_of_views', ['placeholder' => 'меньче чем ...']),
                    ],
                    [
                        'attribute' => 'categoryTitle',
                        'filter' => $filterByCategories,
                    ],
                    [
                        'attribute' => 'tracker_of_addition',
                        'filter' => Item::getAdditionTitles(),
                        'value' => function (Item $model) {
                            return $model->getAdditionTitle();
                        },
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            return Yii::$app->urlHelper->to(['item/' . $action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]);

            echo Html::submitButton(Yii::t('app', 'Удалить'), ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'del']);
            echo Html::endForm(); ?>
        </div>
    </div>
</div>
