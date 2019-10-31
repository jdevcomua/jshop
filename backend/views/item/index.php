<?php

use kartik\export\ExportMenu;
use yii\helpers\Html;
use \common\models\Item;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $filterByCategories array */
/* @var $filterByManufacturers array */
$this->title = Yii::t('app', 'Товары');
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
    'tree',
    'id',
    'title',
    'barcode',
    'code',
    'cost',
    'metro_cost',
    [
        'attribute' => 'metric',
        'value' => function($model){
            return $model->getMetricTitle();

        },
    ],
    'manufacturerTitle',
    [
        'attribute' => 'tracker_of_addition',
        'value' => function (Item $model) {
            return $model->getAdditionTitle();
        },
    ],
];
?>
<div class="item-index">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::encode($this->title) ?>
                <?= Html::a(Yii::t('app', 'Создать товар'), Yii::$app->urlHelper->to(['item/create']), ['class' => 'btn btn-success']) ?>
                <?= ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'exportConfig' => [
                        ExportMenu::FORMAT_TEXT => false,
                        ExportMenu::FORMAT_PDF => false,
                        ExportMenu::FORMAT_HTML => false,
                        ExportMenu::FORMAT_CSV => false,
                    ]
                ]);
                ?>
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
                        },
                        'header' => HTML::tag('span',null,['class'=>'glyphicon glyphicon-alert','title'=>Yii::t('app','For delete or edit')]),
                    ],
                    'id',
                    'title',
                    'updated_at',
                    [
                        'attribute' => 'cost',
                        'filter' => Html::activeTextInput($searchModel, 'cost', ['placeholder' => 'меньше чем ...','class' => 'form-control']),
                    ],
                    [
                        'attribute' => 'count_of_views',
                        'filter' => Html::activeTextInput($searchModel, 'count_of_views', ['placeholder' => 'меньше чем ...','class' => 'form-control']),
                    ],
                    [
                        'attribute' => 'categoryTitle',
                        'filter' => $filterByCategories,
                        'filterInputOptions' => ['class' => 'form-control','prompt' => Yii::t('app','All')],
                    ],
                    [
                        'attribute' => 'manufacturerTitle',
                        'filter' => $filterByManufacturers,
                        'filterInputOptions' => ['class' => 'form-control','prompt' => Yii::t('app','All')],
                    ],
                    [
                        'attribute' => 'tracker_of_addition',
                        'filter' => Item::getAdditionTitles(),
                        'value' => function (Item $model) {
                            return $model->getAdditionTitle();
                        },
                        'filterInputOptions' => ['class' => 'form-control','prompt' => Yii::t('app','All')],
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete} {viewOnSite}',  // the default buttons + your custom button
                        'buttons' => [
                            'viewOnSite' => function($url,Item $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-globe"></span>',$model->getUrl(),['title'=>Yii::t('app','View on site')]);
                            }
                        ]
                    ]
                ],
            ]);

            echo Html::submitButton(Yii::t('app', 'Удалить'), ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'del']);
            echo Html::endForm(); ?>
        </div>
    </div>
</div>
