<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ItemCatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $deleted string */

$this->title = Yii::t('app', 'Категории');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-cat-index">

    <h3><?php echo Html::encode($this->title) . ' ';
        echo Html::a(Yii::t('app', 'Создать категорию'), Yii::$app->urlHelper->to(['item-cat/create']), ['class' => 'btn btn-success'])
        ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if (isset($deleted) && $deleted == '0') { ?>
        <div class="callout callout-danger">
            <h4>Невозможно удалить категорию.</h4>
            <p>Категория содержит товары.</p>
        </div>
    <?php } ?>

    <?php echo Html::beginForm(Yii::$app->urlHelper->to(['item-cat/group']),'post');

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

            ['class' => 'yii\grid\ActionColumn',
                'urlCreator'=>function($action, $model, $key, $index){
                    return Yii::$app->urlHelper->to(['item-cat/'.$action,'id'=>$model->id]);
                }
            ],
        ],
    ]);
    echo Html::submitButton('Редактировать', ['class' => 'btn btn-primary', 'name' => 'action', 'value' => 'edit']) . ' ';
    echo Html::submitButton('Удалить', ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'del']) . ' ';
    echo Html::endForm();?>

</div>
