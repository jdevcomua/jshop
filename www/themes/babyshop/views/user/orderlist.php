<?php
use common\models\WishList;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Orders;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'My Orders';
$this->params['breadcrumbs'][] = ['label' => 'Account Dashboard', 'url' => '/dashboard'];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-main col-sm-9 col-xs-12 wow bounceInUp animated animated" style="visibility: visible;">
                <div class="my-account">

                    <!--page-title-->
                    <!-- BEGIN DASHBOARD-->
                    <div class="dashboard">
                        <div class="recent-orders">
                            <div class="table-responsive">
                                <?php Pjax::begin() ?>
                                <?= \yii\grid\GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'layout'=>"{items}\n<div class='pages'>{pager}</div>",
                                    'tableOptions' => ['class' => 'data-table table-striped', 'id' => 'my-orders-table'],
                                    'columns' => [

                                        [
                                            'class' => 'yii\grid\DataColumn',
                                            'attribute' => 'id',
                                            'headerOptions' => ['class' => 'text-center'],
                                            'label' => 'Order #',
                                            'contentOptions' => ['style' => 'width: ;', 'class' => 'text-center'],
                                        ],
                                        [
                                            'class' => 'yii\grid\DataColumn',
                                            'attribute' => 'timestamp',
                                            'headerOptions' => ['class' => 'text-center'],
                                            'label' => 'Date',
                                            'contentOptions' => ['style' => 'width: ;', 'class' => 'text-center'],
                                        ],
                                        [
                                            'class' => 'yii\grid\DataColumn',
                                            'attribute' => 'sum',
                                            'headerOptions' => ['class' => 'text-center'],
                                            'label' => 'Order total',
                                            'contentOptions' => ['style' => 'width: 1;', 'class' => 'text-center'],
                                            'value' => function ($model, $key, $index, $widget) {
                                                return number_format((float)$model->sum, 2, '.', '');
                                            }
                                        ],
                                        [
                                            'class' => 'yii\grid\DataColumn',
                                            'attribute' => 'order_status',
                                            'headerOptions' => ['class' => 'text-center'],
                                            'label' => 'Status Order',
                                            'contentOptions' => ['style' => 'width: 1;', 'class' => 'text-center'],
                                            'value' => function ($model, $key, $index, $widget) {
                                                return Orders::getStatusTitles()[$model->order_status];
                                            }
                                        ],
                                        [
                                            'class' => 'yii\grid\DataColumn',
                                            'attribute' => 'payment_status',
                                            'headerOptions' => ['class' => 'text-center'],
                                            'label' => 'Status payment',
                                            'contentOptions' => ['style' => 'width: 1;', 'class' => 'text-center'],
                                            'value' => function ($model, $key, $index, $widget) {
                                                return Orders::getPaymentStatusTitles()[$model->payment_status];
                                            }
                                        ],
                                        [
                                            'class' => 'yii\grid\DataColumn',
                                            'headerOptions' => ['class' => 'text-center'],
                                            'format' => 'html' ,
                                            'label' => ' ',
                                            'contentOptions' => ['style' => 'width: 20%;', 'class' => 'text-center'],
                                            'value' => function ($model, $key, $index, $widget) {
                                                return '<span class="nobr"> <a href="' . Url::to(['cart/old-order', 'order_id' => $model->id]) . '">View Order</a> <span class="separator">|</span> <a href="' . Url::to(['cart/reorder', 'order_id' => $model->id]) . '" class="link-reorder">Reorder</a> </span>';
                                            }
                                        ],
                                    ]
                                ]); ?>
                                <?php Pjax::end()?>

                            </div>
                            <!--table-responsive-->
                        </div>
                        <!--recent-orders-->
                    </div>
                </div>
            </section>
            <!--col-main col-sm-9 wow bounceInUp animated-->
            <aside class="col-right sidebar col-sm-3 col-xs-12 wow bounceInUp animated animated" style="visibility: visible;">
                <div class="block block-account">
                    <div class="block-title"> My Account </div>
                    <div class="block-content">
                        <ul>
                            <li><a href="<?= Url::toRoute('user/dashboard') ?>"><span> Account Dashboard</span></a></li>
                            <li><a href="<?= Url::toRoute('user/profile') ?>"><span> Account Information</span></a></li>
                            <li><a href="<?= Url::toRoute('user/change-password') ?>"><span> Change password</span></a></li>
                            <li class="current"><a href="<?= Url::toRoute('user/orderlist') ?>"><span> My Orders</span></a></li>
                            <li><a href="<?= Url::toRoute('user/wishlist') ?>">My Wishlist</a></li>
                            <!--                            <li class="last"><a href="#"><span> Newsletter Subscriptions</span></a></li>-->
                        </ul>
                    </div>
                    <!--block-content-->
                </div>
                <!--block block-account-->

                <div class="custom-slider">
                    <div>
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li class="active" data-target="#carousel-example-generic" data-slide-to="0"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active"><img src="/images/slide2.jpg" alt="slide3">
                                    <div class="carousel-caption">
                                        <h4>Fruit Shop</h4>
                                        <h3><a title=" Sample Product" href="/product-detail.html">Up to 70% Off</a></h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        <a class="link" href="#">Buy Now</a></div>
                                </div>
                                <div class="item"><img src="/images/slide3.jpg" alt="slide1">
                                    <div class="carousel-caption">
                                        <h4>Black Grapes</h4>
                                        <h3><a title=" Sample Product" href="product-detail.html">Mega Sale</a></h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        <a class="link" href="#">Buy Now</a>
                                    </div>
                                </div>
                                <div class="item"><img src="/images/slide1.jpg" alt="slide2">
                                    <div class="carousel-caption">
                                        <h4>Food Farm</h4>
                                        <h3><a title=" Sample Product" href="product-detail.html">Up to 50% Off</a></h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        <a class="link" href="#">Buy Now</a>
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> <span class="sr-only">Next</span> </a></div>
                    </div>
                </div>
            </aside>
            <!--col-right sidebar col-sm-3 wow bounceInUp animated-->
        </div>
        <!--row-->
    </div>
    <!--main container-->
</section>
