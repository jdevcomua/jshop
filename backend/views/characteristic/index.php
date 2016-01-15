<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CharacteristicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Характеристики');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-index">

    <h3><?php echo Html::encode($this->title);
        echo '  ' . Html::a(Yii::t('app', 'Создать характеристику'), Yii::$app->urlHelper->to(['characteristic/create']), ['class' => 'btn btn-success']) ?>

    </h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo Html::beginForm(Yii::$app->urlHelper->to(['characteristic/group']),'post');

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
            /*'id',*/
            'title',
            [
                'attribute' => 'categoryTitle',
                'filter' => $categories,
            ],
            ['class' => 'yii\grid\ActionColumn',
                'urlCreator'=>function($action, $model, $key, $index){
                    return Yii::$app->urlHelper->to(['characteristic/' . $action,'id'=>$model->id]);
                }
            ],
        ],
    ]);
    echo Html::submitButton('Редактировать', ['class' => 'btn btn-primary', 'name' => 'action', 'value' => 'edit']) . ' ';
    echo Html::submitButton('Удалить', ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'del']);
    echo Html::endForm();?>

</div>
