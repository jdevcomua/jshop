<?php
use yii\helpers\Url;
use yii\widgets\Pjax;

?>
<header>
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="header-banner">
                        <div class="assetBlock">
                            <div id="slideshow">
                                <p>Special Offers! - Get <span>50%</span> off on vegetables </p>
                                <p>sale <span>40%</span> of  on bulk shopping! </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="header">
        <div class="container">
            <div class="header-container row">
                <div class="logo"> <a href="<?= Url::home() ?>" title="index">
                        <div><img src="/images/logo.png" alt="logo"></div>
                    </a> </div>
                <div class="fl-nav-menu">
                    <nav>
                        <div class="mm-toggle-wrap">
                            <div class="mm-toggle"><i class="icon-align-justify"></i><span class="mm-label">Menu</span> </div>
                        </div>
                        <div class="nav-inner">
                            <!-- BEGIN NAV -->
                            <ul id="nav" class="hidden-xs">

                                <li> <a class="level-top" href="<?= Url::home() ?>"><span>Home</span></a></li>
                                <?= \www\widgets\category\CategoriesView::widget() ?>


                <!--row-->

                <div class="fl-header-right">
                    <div class="fl-links">
                        <div class="no-js"> <a title="Company" class="clicker"></a>
                            <div class="fl-nav-links">
                                <div class="language-currency">
                                    <div class="fl-language">
                                        <ul class="lang">
                                            <li><a href="#"> <img src="/images/english.png" alt="English"> <span>English</span> </a></li>
                                            <li><a href="#"> <img src="/images/francais.png" alt="French"> <span>French</span> </a></li>
                                            <li><a href="#"> <img src="/images/german.png" alt="German"> <span>German</span> </a></li>
                                        </ul>
                                    </div>
                                    <!--fl-language-->
                                    <!-- END For version 1,2,3,4,6 -->
                                    <!-- For version 1,2,3,4,6 -->
                                    <div class="fl-currency">
                                        <ul class="currencies_list">
                                            <li><a href="#" title="EGP"> £</a></li>
                                            <li><a href="#" title="EUR"> €</a></li>
                                            <li><a href="#" title="USD"> $</a></li>
                                        </ul>
                                    </div>
                                    <!--fl-currency-->
                                    <!-- END For version 1,2,3,4,6 -->
                                </div>
                                <ul class="links">
<!--                                    <li><a href="dashboard.html" title="My Account">My Account</a></li>-->
                                    <li><a href="<?= Url::toRoute('user/wishlist') ?>" title="Wishlist">Wishlist</a></li>
                                    <li><a href="<?= Url::toRoute('cart/index') ?>" title="Cart">Cart</a></li>
<!--                                    <li><a href="blog.html" title="Blog"><span>Blog</span></a></li>-->
                                    <?php if (Yii::$app->user->isGuest) { ?>
                                    <li ><a href="<?= Url::toRoute('user/login') ?>" title="Login"><span>Login</span></a></li>
                                    <li class="last"><a href="<?= Url::toRoute('user/register') ?>" title="Registration"><span>Registration</span></a></li>
                                    <?php } else { ?>
                                    <li ><a href="<?= Url::toRoute('user/logout') ?>" title="Logout"><span>Logout</span></a></li>
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
                                    <div class="top-subtotal"><?= Yii::$app->cart->getCount() ?> items,
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
                                                                                                                    src="<?= ($cartElement->model->images) ? (is_array($urls = $cartElement->model->getOneImageUrl()) ? $urls[0] : $urls) : '/images/product_no_image.jpg' ?>"></a>
                                            <div class="product-details">

                                                <div class="access"><a data-pjax="true" data-reload=0 href="" class="btn-remove1 cart__remove" title="Remove This Item"  data-id="<?= $cartElement->model->getId(); ?>" data-type="<?= $cartElement->model->getType(); ?>">Remove</a></div>
                                                <!--access-->
                                                <strong><?= $cartElement->count ?></strong> x <span class="price"><?= number_format((float) $cartElement->model->getNewPrice(), 2, '.', '') ?></span>
                                                <p class="product-name"><a data-pjax = 0 href="<?= $cartElement->model->getUrl() ?>"><?= $cartElement->model->title ?></a></p>
                                            </div>
                                        </div>
                                    </li>
                                    <?php }?>
                                </ul>
                                <?php } ?>

                                <div class="actions">
                                    <button data-pjax = 0 class="btn-checkout" title="Checkout" type="button" onClick="window.location='<?= Url::toRoute('cart/index')?>'"><span>Checkout</span></button>
                                </div>
                                <!--actions-->
                            </div>
                            <!--fl-mini-cart-content-->
                        </div>
                        <?php Pjax::end()?>
                    </div>
                    <!--mini-cart-->
                    <div class="collapse navbar-collapse">
                        <form class="navbar-form" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="input-group-btn">
                  <button type="submit" class="search-btn"> <span class="glyphicon glyphicon-search"> <span class="sr-only">Search</span> </span> </button>
                  </span> </div>
                        </form>
                    </div>
                    <!--links-->
                </div>
            </div>
        </div>
    </div>
</header>