<?php
use yii\helpers\Url;
use yii\widgets\Pjax;

?>
<header>
    <div id="header">
        <div class="container">
            <div class="header-container row">
                <div class="logo"> <a href="<?= Url::home() ?>" title="<?=Yii::t('app','Home')?>">
                        <div><img src="/images/logo.svg" alt="sdelivery logo" width="161px" height="40px"></div>
                    </a> </div>
                <div class="fl-nav-menu">
                    <nav>
                        <div class="mm-toggle-wrap">
                            <div class="mm-toggle"><i class="icon-align-justify"></i><span class="mm-label"><?= Yii::t('app','Menu')?></span> </div>
                        </div>
                        <div class="fl-cart-contain mm-toggle-wrap">
                            <?php Pjax::begin(['id'=>'mobile_cart','enablePushState' => false]) ?>
                            <div class="mini-cart">
                                <div class="basket"> <a data-pjax = 0 href="<?= Url::toRoute('cart/index') ?>"><span> <?= Yii::$app->cart->getCount() ?> </span></a> </div>
                                <div class="fl-mini-cart-content" style="display: none;">
                                    <div class="block-subtitle">
                                        <div class="top-subtotal"><?= Yii::$app->cart->getCount() ?> <?= Yii::t('app','Items')?>,
                                            <span class="price"><?= number_format((float)Yii::$app->cart->getSum(), 2, '.', '');  ?></span> </div>
                                        <!--top-subtotal-->
                                        <!--pull-right-->
                                    </div>
                                    <!--block-subtitle-->

                                    <?php if(!Yii::$app->cart->isEmpty()) { ?>
                                        <ul class="mini-products-list" id="cart-sidebar">
                                            <?php foreach (Yii::$app->cart->getModels() as $key => $cartElement) {?>

                                                <li class="item <?=($key == 0) ? 'first' : ''?> <?=($key == count(Yii::$app->cart->getModels())-1) ? 'last' : ''?>">
                                                    <div class="item-inner"><a data-pjax = 0 class="product-image" title="<?= $cartElement->model->title?>"
                                                                               href="<?= $cartElement->model->getUrl() ?>"><img alt="<?= $cartElement->model->title?>"
                                                                                                                                src="<?= ($cartElement->model->images) ? (is_array($urls = $cartElement->model->getOneImageUrl()) ? $urls[0] : $urls) : Yii::$app->params['defaultKitImage'] ?>"></a>
                                                        <div class="product-details">

                                                            <div class="access"><a data-pjax="true" data-reload=0 href="" class="btn-remove1 cart__remove" title="Remove This Item"  data-id="<?= $cartElement->model->getId(); ?>" data-type="<?= $cartElement->model->getType(); ?>"><?= Yii::t('app','Remove')?></a></div>
                                                            <!--access-->
                                                            <strong><?= $cartElement->count ?></strong> <?=$cartElement->model->getMetricTitle()?> X <span class="price"><?= number_format((float) $cartElement->model->getNewPrice(), 2, '.', '') ?></span>
                                                            <p class="product-name"><a data-pjax = 0 href="<?= $cartElement->model->getUrl() ?>"><?= $cartElement->model->title ?></a></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php }?>
                                        </ul>
                                    <?php } ?>

                                    <div class="actions">
                                        <button data-pjax = 0 class="btn-checkout" title="Checkout" type="button" onClick="window.location='<?= Url::toRoute('cart/index')?>'"><span><?= Yii::t('app','Checkout')?></span></button>
                                    </div>
                                    <!--actions-->
                                </div>
                                <!--fl-mini-cart-content-->
                            </div>
                            <?php Pjax::end()?>
                        </div>

                        <div class="nav-inner">
                            <!-- BEGIN NAV -->
                            <ul id="nav" class="hidden-xs">

                                <li> <a class="level-top" href="<?= Url::home() ?>"><span><?=Yii::t('app','Home')?></span></a></li>
                                <?= \www\widgets\category\LeftTop10::widget() ?>


                <!--row-->

                <div class="fl-header-right">
                    <div class="fl-links">
                        <div class="no-js"> <a  href="<?= Url::toRoute('user/dashboard') ?>" title="<?=Yii::t('app','Dashboard')?>" class="clicker"></a>
                            <div class="fl-nav-links">
                                <ul class="links">
                                    <?php if (Yii::$app->user->isGuest) { ?>
                                    <li ><a href="<?= Url::toRoute('user/login') ?>" title="Login"><span><?= Yii::t('app','Login')?></span></a></li>
                                    <li class="last"><a href="<?= Url::toRoute('user/register') ?>" title="Registration"><span><?= Yii::t('app','Registration')?></span></a></li>
                                    <?php } else { ?>
                                        <li><a href="<?= Url::toRoute('user/dashboard') ?>" title="<?= Yii::t('app','Dashboard')?>"><?= Yii::t('app','Dashboard')?></a></li>
                                        <li><a href="<?= Url::toRoute('user/wishlist') ?>" title="<?= Yii::t('app','Wishlist')?>"><?= Yii::t('app','Wishlist')?></a></li>
                                        <li ><a href="<?= Url::toRoute('user/logout') ?>" title="Logout"><span><?= Yii::t('app','Logout')?></span></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="fl-cart-contain">
                        <?php Pjax::begin(['id'=>'cart','enablePushState' => false]) ?>
                        <div class="mini-cart">
                            <div class="basket"> <a data-pjax = 0 href="<?= Url::toRoute('cart/index') ?>"><span> <?= Yii::$app->cart->getCount() ?> </span></a> </div>
                            <div class="fl-mini-cart-content" style="display: none;">
                                <div class="block-subtitle">
                                    <div class="top-subtotal"><?= Yii::$app->cart->getCount() ?> <?= Yii::t('app','Items')?>,
                                        <span class="price"><?= number_format((float)Yii::$app->cart->getSum(), 2, '.', '');  ?></span> </div>
                                    <!--top-subtotal-->
                                    <!--pull-right-->
                                </div>
                                <!--block-subtitle-->

                                <?php if(!Yii::$app->cart->isEmpty()) { ?>
                                <ul class="mini-products-list" id="cart-sidebar">
                                    <?php foreach (Yii::$app->cart->getModels() as $key => $cartElement) {?>

                                    <li class="item <?=($key == 0) ? 'first' : ''?> <?=($key == count(Yii::$app->cart->getModels())-1) ? 'last' : ''?>">
                                        <div class="item-inner"><a data-pjax = 0 class="product-image" title="<?= $cartElement->model->title?>"
                                                                   href="<?= $cartElement->model->getUrl() ?>"><img alt="<?= $cartElement->model->title?>"
                                                                                                                    src="<?= ($cartElement->model->images) ? (is_array($urls = $cartElement->model->getOneImageUrl()) ? $urls[0] : $urls) : Yii::$app->params['defaultKitImage'] ?>"></a>
                                            <div class="product-details">

                                                <div class="access"><a data-pjax="true" data-reload=0 href="" class="btn-remove1 cart__remove" title="Remove This Item"  data-id="<?= $cartElement->model->getId(); ?>" data-type="<?= $cartElement->model->getType(); ?>"><?= Yii::t('app','Remove')?></a></div>
                                                <!--access-->
                                                <strong><?= $cartElement->count ?></strong> <?=$cartElement->model->getMetricTitle()?> X <span class="price"><?= number_format((float) $cartElement->model->getNewPrice(), 2, '.', '') ?></span>
                                                <p class="product-name"><a data-pjax = 0 href="<?= $cartElement->model->getUrl() ?>"><?= $cartElement->model->title ?></a></p>
                                            </div>
                                        </div>
                                    </li>
                                    <?php }?>
                                </ul>
                                <?php } ?>

                                <div class="actions">
                                    <button data-pjax = 0 class="btn-checkout" title="Checkout" type="button" onClick="window.location='<?= Url::toRoute('cart/index')?>'"><span><?= Yii::t('app','Checkout')?></span></button>
                                </div>
                                <!--actions-->
                            </div>
                            <!--fl-mini-cart-content-->
                        </div>
                        <?php Pjax::end()?>
                    </div>

                    <!--mini-cart-->
                    <div class="collapse navbar-collapse">
                        <form class="navbar-form" role="search" method="get" action="search">
                            <div class="input-group">
                                <input id="search" name="search" type="text" class="form-control" placeholder="<?=Yii::t('app','Search')?>">
                                <span class="input-group-btn">
                  <button type="submit" class="search-btn"> <span class="glyphicon glyphicon-search"> <span class="sr-only"><?= Yii::t('app','Search')?></span> </span> </button>
                  </span> </div>
                        </form>
                    </div>
                    <!--links-->
                </div>
            </div>
        </div>
    </div>
</header>
