<?php

use common\models\ItemCat;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ItemCatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $deleted string */

$this->title = Yii::t('app', 'Категории');
$this->params['breadcrumbs'][] = $this->title;
$map = ArrayHelper::getColumn($dataProvider->models,'id');
?>
<div class="item-cat-index">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::encode($this->title) ?>
                <?= Html::a(Yii::t('app', 'Создать категорию'),['item-cat/create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('app', 'Tree'), ['index-tree'], ['class' => 'btn btn-success']) ?>
            </h3>
        </div>
        <div class="box-body">
            <?php if (isset($deleted) && $deleted == '0') { ?>
                <div class="callout callout-danger">
                    <h4>Невозможно удалить категорию.</h4>
                    <p>Категория содержит товары.</p>
                </div>
            <?php } ?>
            <?php Pjax::begin(['id'=>'itemCatList']) ?>

            <?php echo Html::beginForm(Yii::$app->urlHelper->to(['item-cat/group']), 'post');
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
                    [
                        'attribute' => 'id',
                        'filter' => false,

                    ],
                    'title',
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'name' => 'in_slider',
                        // you may configure additional properties here
                        'checkboxOptions' => function ($model, $key, $index, $column) {
                            if ($model->in_slider){
                                return ['checked' => 'checked','onclick' => 'js:inSlider(this.value, this.checked)'];
                            }else{
                                return ['onclick' => 'js:inSlider(this.value, this.checked)'];
                            }

                        },
                        'header' => Yii::t('app','In slider'),
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{up} {down} {view} {update} {delete}',  // the default buttons + your custom button
                        'buttons' => [
                            'up' => function($url,ItemCat $model, $key) use ($map,$dataProvider) {
                                if ($key != reset($map))
                                {
                                    return Html::a('<span class="glyphicon glyphicon-chevron-up"></span>','#',['data-id'=>$model->id,'title'=>Yii::t('app','Prev'),'onclick' => 'js:orderUp($(this).data(\'id\'))']);
                                }
                            },
                            'down' => function($url,ItemCat $model, $key) use ($map,$dataProvider) {
                                if($key != end($map))
                                {
                                    return Html::a('<span class="glyphicon glyphicon-chevron-down"></span>','#',['data-id'=>$model->id,'title'=>Yii::t('app','Next'),'onclick' => 'js:orderDown($(this).data(\'id\'))']);
                                }
                            }
                        ]
                    ],
                ],
            ]);
            echo Html::submitButton('Редактировать', ['class' => 'btn btn-primary', 'name' => 'action', 'value' => 'edit']) . ' ';
            echo Html::submitButton('Удалить', ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'del']) . ' ';
            echo Html::endForm(); ?>
            <?php Pjax::end() ?>
        </div>
    </div>
</div>
