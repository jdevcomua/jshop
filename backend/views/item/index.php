<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Товары');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h3><?php echo Html::encode($this->title) . ' ';
        echo Html::a(Yii::t('app', 'Создать предмет'), Yii::$app->urlHelper->to(['item/create']), ['class' => 'btn btn-success'])?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo Html::beginForm(['del'],'post');

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
            'cost',

            [
                'attribute'=>'categoryTitle',
                'filter'=>\common\models\Item::getCategorys(),
            ],
            ['class' => 'yii\grid\ActionColumn',
                'urlCreator'=>function($action, $model, $key, $index){
                    return Yii::$app->urlHelper->to(['item/'.$action,'id'=>$model->id]);
                }
            ],
        ],
    ]);

    echo Html::submitButton(Yii::t('app', 'Удалить'), ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'del']);
    echo Html::endForm();?>

</div>
