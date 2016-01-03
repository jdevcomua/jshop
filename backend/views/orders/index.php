<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Заказы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?php echo Html::encode($this->title). ' ';
        echo Html::a(Yii::t('app', 'Создать заказ'), ['create'], ['class' => 'btn btn-success'])?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo Html::beginForm(Yii::$app->urlHelper->to(['orders/group']),'post');

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
            //'id',
            [
                'attribute' => 'order_status',
                'filter' => ['Новый' => 'Новый',
                            'Отправлен' => 'Отправлен',
                            'Доставлен' => 'Доставлен']
            ],
            'timestamp',
            //'address',
            [
                'attribute' => 'name',
                'label' => 'Заказчик'
            ],
            'countItems',
            'sum',
            [
                'attribute' => 'payment_status',
                'filter' => ['Оплачен' => 'Оплачен',
                            'Не оплачен' => 'Не оплачен']
            ],
            // 'phone',
            // 'delivery',
            // 'mail',
            // 'payment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

    echo Html::submitButton('Оплачено', ['class' => 'btn btn-success', 'name' => 'action', 'value' => 'paid']) . ' ';
    echo Html::submitButton('Удалить', ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'delete']);
    echo Html::endForm();?>

</div>
