<?php

use common\models\OrderItem;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $orderItems \yii\data\ActiveDataProvider */

$this->title = 'Заказ №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Заказы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <p>
                <?php echo Html::a(Yii::t('app', 'Оплачено'), Yii::$app->urlHelper->to(['orders/paid', 'id' => $model->id]),
                        ['class' => 'btn btn-success']) . ' ';
                echo Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to(['orders/update', 'id' => $model->id]),
                        ['class' => 'btn btn-primary']) . ' ';
                echo Html::a(Yii::t('app', 'Удалить'), Yii::$app->urlHelper->to(['orders/delete', 'id' => $model->id]), [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот заказ?'),
                        'method' => 'post',
                    ],
                ]); ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'timestamp',
                    'name',
                    'phone',
                    'address',
                    'email',
                    'comment',
                    [
                        'attribute' => 'order_status',
                        'value' => $model->getStatusTitle(),
                    ],
                    [
                        'attribute' => 'payment_status',
                        'value' => $model->getPaymentStatusTitle(),
                    ],
                    'sum',
                ],
            ]); ?>

            <h4>Товары</h4>

            <?= GridView::widget([
                'dataProvider' => $orderItems,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'item.title',
                        'value' => function (OrderItem $data) {
                            return Html::a(Html::encode($data->item->title), Yii::$app->urlHelper->to(['item/view', 'id' => $data->item->id]));
                        },
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'Цена за шт.',
                        'value' => function (OrderItem $model) {
                            return $model->sum/$model->count;
                        }
                    ],
                    'count',
                    'sum'
                ],
            ]); ?>
        </div>
    </div>
</div>
