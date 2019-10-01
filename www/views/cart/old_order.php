<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\models\Orders;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\Orders */
/* @var $user \common\models\User */
/* @var $itemsDataProvider \yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Order #') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Корзина'), 'url' => ['/cart']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-main col-sm-9 wow bounceInUp animated animated" style="visibility: visible;">
                <?php Pjax::begin() ?>
                <?= \yii\widgets\DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        [
                            'label' => Yii::t('app','User'),
                            'value' => $model->user->name . ' ' . $model->user->surname,
                        ],
                        'timestamp:datetime',
                        'email:email',
                        'phone',
                        [
                            'label' => Yii::t('app','Cost'),
                            'value' => number_format((float)$model->sum, 2, '.', ''),
                        ],
                        [
                            'label' => Yii::t('app','Order status'),
                            'value' => Orders::getStatusTitles()[$model->order_status],
                        ],
                        [
                            'label' => Yii::t('app','Payment status'),
                            'value' => Orders::getPaymentStatusTitles()[$model->payment_status],
                        ],
                        'comment:html',
                        [
                            'label' => Yii::t('app','Basket'),
                            'format' => 'raw',
                            'value' => \yii\grid\GridView::widget([
                                'dataProvider' => $itemsDataProvider,
                                'layout'=>"{items}\n<div class='pages'>{pager}</div>",
                                'tableOptions' => ['class' => 'data-table table-striped', 'id' => 'my-orders-table'],
                                'columns' => [

                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'attribute' => 'item_id',
                                        'headerOptions' => ['class' => 'text-center'],
                                        'format' => 'raw',
                                        'label' => Yii::t('app','Product'),
                                        'contentOptions' => ['style' => 'width: ;', 'class' => 'text-center'],
                                        'content' => function ($model, $key, $index, $widget) {
                                            return Html::a($model->item->title,$model->item->getUrl(),['data-pjax' => '0']);
                                        }
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'attribute' => 'count',
                                        'headerOptions' => ['class' => 'text-center'],
                                        'label' => Yii::t('app','Number'),
                                        'contentOptions' => ['style' => 'width: ;', 'class' => 'text-center'],
                                    ],
                                    [
                                        'class' => 'yii\grid\DataColumn',
                                        'attribute' => 'sum',
                                        'headerOptions' => ['class' => 'text-center'],
                                        'label' => Yii::t('app','Cost of position'),
                                        'contentOptions' => ['style' => 'width: ;', 'class' => 'text-center'],
                                        'value' => function ($model, $key, $index, $widget) {
                                            return number_format((float)$model->sum, 2, '.', '');
                                        }
                                    ],
                                ]
                            ]),
                        ],
                    ],
                ]) ?>
                <?php Pjax::end()?>
            </section>

            <aside class="col-right sidebar col-sm-3 wow bounceInUp animated animated" style="visibility: visible;">
                <div id="checkout-progress-wrapper">
                    <div class="block block-progress">
                        <div class="block-title"> <?=Yii::t('app','Your Checkout')?> </div>
                        <div class="block-content">
                            <dl>
                                <div id="shipping_method-progress-opcheckout">
                                    <dt> <?=Yii::t('app','Shipping Method')?> : <?= (Yii::$app->user->isGuest) ? Yii::t('app','Not registered') : Yii::t('app','Registered') ?> </dt>
                                </div>
                                <!--                                <div id="payment-progress-opcheckout">-->
                                <!--                                    <dt> Payment Method</dt>-->
                                <!--                                </div>-->
                            </dl>
                        </div>
                    </div>
                </div>
            </aside>
            <!--col-right sidebar-->
        </div>
        <!--row-->
    </div>
    <!--main-container-inner-->
</div>
