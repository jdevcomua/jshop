<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\User */
/* @var $orderDataProvider \yii\data\ActiveDataProvider */

use common\models\WishList;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Orders;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Account Information');
$this->params['breadcrumbs'][] = ['label' => 'Account Dashboard', 'url' => '/dashboard'];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-main col-sm-9 col-xs-12 wow bounceInUp animated animated" style="visibility: visible;">
                <div class="dashboard">
                    <?php $form = ActiveForm::begin(); ?>
                    <ol class="one-page-checkout">
                        <li  class="section allow active">
                            <div class="step a-item" style="">
                                <fieldset class="group-select">
                                    <ul class="">
                                        <li>
                                            <fieldset>
                                                <ul>
                                                    <li class="fields">
                                                        <div class="input-box">
                                                            <label for="orders-address"><?=Yii::t('app', 'Username')?></label>
                                                            <?= $form->field($model, 'username')->textInput(['class' => 'input-text'])->label(false) ?>
                                                        </div>
                                                    </li>
                                                    <li class="fields">
                                                        <div class="input-box">
                                                            <label for="orders-address"><?=Yii::t('app', 'Mail')?><span class="required">*</span></label>
                                                            <?= $form->field($model, 'mail')->textInput(['class' => 'input-text', 'disabled' => true])->label(false) ?>
                                                        </div>
                                                    </li>
                                                    <li class="fields">
                                                        <div class="input-box">
                                                            <label for="orders-mail"><?=Yii::t('app', 'Name')?></label>
                                                            <?= $form->field($model, 'name')->textInput(['class' => 'input-text'])->label(false) ?>
                                                        </div>
                                                    </li>
                                                    <li class="fields">
                                                        <div class="input-box">
                                                            <label for="orders-address"><?=Yii::t('app', 'Surname')?></label>
                                                            <?= $form->field($model, 'surname')->textInput(['class' => 'input-text'])->label(false) ?>
                                                        </div>
                                                    </li>
                                                    <li class="fields">
                                                        <div class="input-box">
                                                            <label for="orders-address"><?=Yii::t('app', 'Phone number')?></label>
                                                            <?= $form->field($model, 'phone')->textInput(['class' => 'input-text'])->label(false) ?>
                                                        </div>
                                                    </li>
                                                    <li class="fields">
                                                        <div class="input-box">
                                                            <label for="orders-mail"><?=Yii::t('app', 'Address')?></label>
                                                            <?= $form->field($model, 'address')->textInput(['class' => 'input-text'])->label(false) ?>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </fieldset>
                                        </li>
                                        <li>
                                            <button class="button" type="submit" ><?php echo Yii::t('app', 'Save'); ?></button>
                                        </li>
                                    </ul>
                                </fieldset>
                            </div>
                        </li>
                    </ol>
                    <?php ActiveForm::end(); ?>
                </div>
            </section>
            <!--col-main col-sm-9 wow bounceInUp animated-->
            <aside class="col-right sidebar col-sm-3 col-xs-12 wow bounceInUp animated animated" style="visibility: visible;">
                <div class="block block-account">
                    <div class="block-title"> My Account </div>
                    <div class="block-content">
                        <ul>
                            <li><a href="<?= Url::toRoute('user/dashboard') ?>"><span> <?=Yii::t('app', 'Account Dashboard')?></span></a></li>
                            <li class="current"><a href="<?= Url::toRoute('user/profile') ?>"><span> <?=Yii::t('app', 'Account Information')?></span></a></li>
                            <li><a href="<?= Url::toRoute('user/change-password') ?>"><span> <?=Yii::t('app', 'Change password')?></span></a></li>
                            <li><a href="<?= Url::toRoute('user/orderlist') ?>"><span> <?=Yii::t('app', 'My Orders')?></span></a></li>
                            <li><a href="<?= Url::toRoute('user/wishlist') ?>"> <?=Yii::t('app', 'My Wishlist')?></a></li>
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
