<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ItemCatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Категории');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-cat-index">

    <h3><?php echo Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('app', 'Создать категорию'), Yii::$app->urlHelper->to(['item-cat/create']), ['class' => 'btn btn-success']) ?>
    </p>

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

    echo Html::submitButton('Удалить', ['class' => 'btn btn-info', 'name' => 'action', 'value' => 'del']) . ' ';
    echo Html::submitButton('Редактировать', ['class' => 'btn btn-info', 'name' => 'action', 'value' => 'edit']);
    echo Html::endForm();?>

</div>
