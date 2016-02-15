<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h3><?php echo Html::encode($this->title) ?></h3>

    <p>
        <?php echo Html::a(Yii::t('app', 'Оплачено'), ['paid', 'id' => $model->id], ['class' => 'btn btn-success']) . ' ';
        echo Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) . ' ';
        echo Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот заказ?'),
                'method' => 'post',
            ],
        ]); ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'timestamp',
            'address',
            'name',
            'phone',
            'delivery',
            'mail',
            'payment',
        ],
    ]);

    echo '<h3>Товары</h3>';

    echo GridView::widget([
    'dataProvider' => $orderItems,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'item.title',
        'count',
        'sum'
        ],
    ]); ?>

</div>
