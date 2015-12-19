<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\UrlHelper;
use yii\helpers\Url;
use Yii;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Товары');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать предмет'), UrlHelper::to(['item/create']), ['class' => 'btn btn-success']) ?>
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
            'cost',

            [
            'attribute'=>'categoryTitle',
            'filter'=>\common\models\Item::getCategorys(),
            ],
            ['class' => 'yii\grid\ActionColumn',
                'urlCreator'=>function($action, $model, $key, $index){
                    return [Yii::$app->language.'/item/'.$action,'id'=>$model->id];
                }
            ],
        ],
    ]); ?>

    <?=Html::submitButton(\Yii::t('app', 'Удалить'), ['class' => 'btn btn-info',]);?>
    <?= Html::endForm();?>

</div>
