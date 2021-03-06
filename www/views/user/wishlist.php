<?php

use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\User */
/* @var $wishDataProvider \yii\data\ActiveDataProvider */
/* @var $list \common\models\WishList */

$this->title = Yii::t('app', 'My Wishlist');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Account Dashboard'), 'url' => '/dashboard'];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-main col-sm-9 col-xs-12 wow bounceInUp animated animated" style="visibility: visible;">
                <div class="my-account">

                    <?php Pjax::begin(['id' => 'wishlist'])?>
                    <div class="my-wishlist">
                        <?php $form = \yii\widgets\ActiveForm::begin(['options' => ['data-pjax' => true]])?>
                            <fieldset>
                                <input name="form_key" type="hidden" value="EPYwQxF6xoWcjLUr">
                                <?= \yii\widgets\ListView::widget([
                                    'dataProvider' => $wishDataProvider,
                                    'itemView' => function ($model, $key, $index, $widget) {
                                        return $this->render('_item_wish', ['model' => $model ]);
                                    },
                                     'layout' => '
                                      <div class="table" style="overflow: auto">
                                    <table class="clean-table linearize-table data-table table-striped" id="wishlist-table">
                                        <thead>
                                        <tr class="first last">
                                            <th class="customer-wishlist-item-image"></th>
                                            <th class="customer-wishlist-item-info"></th>
                                            <th class="customer-wishlist-item-price">'.Yii::t('app', 'Price').'</th>
                                            <th class="customer-wishlist-item-cart"></th>
                                            <th class="customer-wishlist-item-remove"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                         {items}
                                        </tbody>
                                    </table>
                                </div>
                                <div class="buttons-set buttons-set2">
                                    <button type="submit" title="Add All to Cart" class="button btn-add"><span>'.Yii::t('app', 'Add All to Cart').'</span></button>
                                    <button type="button" name="do" title="Update Wishlist" data-pjax="true" onclick="$.pjax.reload(\'#wishlist\'); return false;"  class="button btn-update"><span>'.Yii::t('app', 'Update Wishlist').'</span></button>
                                </div>',
                                    'pager' => [
                                        'disabledListItemSubTagOptions' => ['tag' => 'a']
                                    ],
                                    'emptyText' =>  '<div class="table-responsive" align="center">
                                            <p>'.Yii::t('app', 'No items at your Wishlist!').'</p>
                                            </div>
                                            <div class="buttons-set buttons-set2">
                                                <button type="button" data-pjax="true" onclick="$.pjax.reload(\'#wishlist\'); return false;" name="do" title="Update Wishlist" class="button btn-update"><span>'.Yii::t('app', 'Update Wishlist').'</span></button>
                                            </div>'
                                ]); ?>
                            </fieldset>
                        <?php \yii\widgets\ActiveForm::end()?>
                    </div>
                    <?php Pjax::end()?>
                </div>
            </section>
            <!--col-main col-sm-9 wow bounceInUp animated-->
            <aside class="col-right sidebar col-sm-3 col-xs-12 wow bounceInUp animated animated" style="visibility: visible;">
                <div class="block block-account">
                    <div class="block-title"><?=Yii::t('app', 'My Account')?>  </div>
                    <div class="block-content">
                        <ul>
                            <li><a href="<?= Url::toRoute('user/dashboard') ?>"><span> <?=Yii::t('app', 'Account Dashboard')?></span></a></li>
                            <li><a href="<?= Url::toRoute('user/profile') ?>"><span> <?=Yii::t('app', 'Account Information')?></span></a></li>
                            <li><a href="<?= Url::toRoute('user/change-password') ?>"><span> <?=Yii::t('app', 'Change Password')?></span></a></li>
                            <li><a href="<?= Url::toRoute('user/orderlist') ?>"><span> <?=Yii::t('app', 'My Orders')?></span></a></li>
                            <li class="current"><a href="<?= Url::toRoute('user/wishlist') ?>"> <?=Yii::t('app', 'My Wishlist')?></a></li>
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
                                        <h4><?=Yii::t('app', 'Fruit Shop')?></h4>
                                        <h3><a title=" Sample Product" href="/product-detail.html"><?=Yii::t('app', 'Up to 70% Off')?></a></h3>
                                        <p><?=Yii::t('app', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.')?></p>
                                        <a class="link" href="#"><?=Yii::t('app', 'Buy Now')?></a></div>
                                </div>
                                <div class="item"><img src="/images/slide3.jpg" alt="slide1">
                                    <div class="carousel-caption">
                                        <h4><?=Yii::t('app', 'Black Grapes')?></h4>
                                        <h3><a title=" Sample Product" href="product-detail.html"><?=Yii::t('app', 'Mega Sale')?></a></h3>
                                        <p><?=Yii::t('app', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.')?></p>
                                        <a class="link" href="#"><?=Yii::t('app', 'Buy Now')?></a>
                                    </div>
                                </div>
                                <div class="item"><img src="/images/slide1.jpg" alt="slide2">
                                    <div class="carousel-caption">
                                        <h4><?=Yii::t('app', 'Food Farm')?></h4>
                                        <h3><a title=" Sample Product" href="product-detail.html"><?=Yii::t('app', 'Up to 50% Off')?></a></h3>
                                        <p><?=Yii::t('app', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.')?></p>
                                        <a class="link" href="#"><?=Yii::t('app', 'Buy Now')?></a>
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> <span class="sr-only"><?=Yii::t('app', 'Previous')?></span> </a> <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> <span class="sr-only"><?=Yii::t('app', 'Next')?></span> </a></div>
                    </div>
                </div>
            </aside>
            <!--col-right sidebar col-sm-3 wow bounceInUp animated-->
        </div>
        <!--row-->
    </div>
    <!--main container-->
</section>