<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OrderItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Заказы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-item-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать заказ'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=Html::beginForm(['del'],'post');?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'name' => 'id',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->id];
                }
            ],
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'order_id',
            'item.title',
            'item.category.title',
            'order.user.name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?=Html::submitButton('Send', ['class' => 'btn btn-info',]);?>
    <?= Html::endForm();?>

</div>
