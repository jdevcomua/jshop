<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\UrlHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CharacteristicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Характеристики');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать характеристику'), UrlHelper::to(['characteristic/create']), ['class' => 'btn btn-success']) ?>
    </p>

    <?=Html::beginForm(['del'],'post');?>

    <?= GridView::widget([
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
            [
                'attribute'=>'categoryTitle',
                'filter'=>\common\models\Characteristic::getCategorys(),
            ],
            ['class' => 'yii\grid\ActionColumn',
                'urlCreator'=>function($action, $model, $key, $index){
                    return [Yii::$app->language.'/characteristic/'.$action,'id'=>$model->id];
                }
            ],
        ],
    ]); ?>

    <?=Html::submitButton('Удалить', ['class' => 'btn btn-info',]);?>
    <?= Html::endForm();?>

</div>
