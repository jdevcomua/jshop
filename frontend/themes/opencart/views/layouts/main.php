<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\themes\opencart\OpencartAsset;
use frontend\widgets\category\CategoriesView;
use yii\helpers\Url;

$basicAsset = OpencartAsset::register($this);
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html dir="ltr" lang="en"><!--<![endif]-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $this->title ?></title>
        <!--<base href="http://demo.opencart.com/">-->
        <base href=".">
        <meta name="description" content="My Store">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--        <script src="./Your Store_files/nr-963.min.js"></script>-->
<!--        <link href="http://demo.opencart.com/image/catalog/cart.png" rel="icon">-->
<!--        <link href="./Your Store_files/css" rel="stylesheet" type="text/css">-->
        <?php $this->head(); ?>
    </head>
    <body class="common-home" data-feedly-mini="yes">
    <?php $this->beginBody(); ?>
    <nav id="top">
        <div class="container">
            <?php /*
            <div class="pull-left">
                <form action="http://demo.opencart.com/index.php?route=common/currency/currency" method="post"
                      enctype="multipart/form-data" id="currency">
                    <div class="btn-group">
                        <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <strong>$</strong>
                            <span class="hidden-xs hidden-sm hidden-md">Currency</span> <i class="fa fa-caret-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button class="currency-select btn btn-link btn-block" type="button" name="EUR">€ Euro
                                </button>
                            </li>
                            <li>
                                <button class="currency-select btn btn-link btn-block" type="button" name="GBP">£ Pound
                                    Sterling
                                </button>
                            </li>
                            <li>
                                <button class="currency-select btn btn-link btn-block" type="button" name="USD">$ US
                                    Dollar
                                </button>
                            </li>
                        </ul>
                    </div>
                    <input type="hidden" name="code" value="">
                    <input type="hidden" name="redirect" value="http://demo.opencart.com/index.php?route=common/home">
                </form>
            </div>
            */ ?>
            <div id="top-links" class="nav pull-right">
                <ul class="list-inline">
                    <li><a href="<?= Url::to('site/contact')?>"><i class="fa fa-phone"></i></a>
                        <span class="hidden-xs hidden-sm hidden-md">123456789</span>
                    </li>
                    <li class="dropdown">
                        <a href="<?= Url::to('user/profile')?>" title="My Account" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span class="hidden-xs hidden-sm hidden-md"><?= Yii::t('app', 'Профиль')?></span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="<?= Url::to('user/register')?>"><?= Yii::t('app', 'Регистрация')?></a></li>
                            <li><a href="<?= Url::to('user/login')?>"><?= Yii::t('app', 'Авторизация')?></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?= Url::to('user/Wishlist')?>" id="wishlist-total" title="<?= Yii::t('app', 'Список желаний')?> (0)"><i class="fa fa-heart"></i>
                            <span class="hidden-xs hidden-sm hidden-md"><?= Yii::t('app', 'Список желаний')?> (0)</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to('cart/index')?>" title="Checkout">
                            <i class="fa fa-share"></i>
                            <span class="hidden-xs hidden-sm hidden-md"><?= Yii::t('app', 'Оплатить')?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div id="logo">
                        <a href="<?= Url::to('/')?>"><img src="<?= Url::base() . '/images/logo.png'?>" title="Your Store" alt="Your Store" class="img-responsive"></a>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div id="search" class="input-group">
                        <input type="text" name="search" value="" placeholder="<?=Yii::t('app', 'Поиск')?>" class="form-control input-lg">
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div id="cart" class="btn-group btn-block">
                        <a class="btn btn-inverse btn-block btn-lg" href="<?= Url::to('cart/index')?>">
                            <i class="fa fa-shopping-cart"></i>
                            <span id="cart-total"><span id="countItems"><?= Yii::$app->cart->getCount() ?></span> <?=Yii::t('app', 'товар(ов)')?> - <span id="priceItems"><?= Yii::$app->cart->getSum() ?></span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?= CategoriesView::widget();?>
    <div class="container">
        <div class="row">
            <div id="content" class="col-sm-12">
                <?= $content ?>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h5>Information</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="http://demo.opencart.com/index.php?route=information/information&amp;information_id=4">About
                                Us</a></li>
                        <li>
                            <a href="http://demo.opencart.com/index.php?route=information/information&amp;information_id=6">Delivery
                                Information</a></li>
                        <li>
                            <a href="http://demo.opencart.com/index.php?route=information/information&amp;information_id=3">Privacy
                                Policy</a></li>
                        <li>
                            <a href="http://demo.opencart.com/index.php?route=information/information&amp;information_id=5">Terms
                                &amp; Conditions</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Customer Service</h5>
                    <ul class="list-unstyled">
                        <li><a href="http://demo.opencart.com/index.php?route=information/contact">Contact Us</a></li>
                        <li><a href="http://demo.opencart.com/index.php?route=account/return/add">Returns</a></li>
                        <li><a href="http://demo.opencart.com/index.php?route=information/sitemap">Site Map</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Extras</h5>
                    <ul class="list-unstyled">
                        <li><a href="http://demo.opencart.com/index.php?route=product/manufacturer">Brands</a></li>
                        <li><a href="http://demo.opencart.com/index.php?route=account/voucher">Gift Vouchers</a></li>
                        <li><a href="http://demo.opencart.com/index.php?route=affiliate/account">Affiliates</a></li>
                        <li><a href="http://demo.opencart.com/index.php?route=product/special">Specials</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>My Account</h5>
                    <ul class="list-unstyled">
                        <li><a href="http://demo.opencart.com/index.php?route=account/account">My Account</a></li>
                        <li><a href="http://demo.opencart.com/index.php?route=account/order">Order History</a></li>
                        <li><a href="http://demo.opencart.com/index.php?route=account/wishlist">Wish List</a></li>
                        <li><a href="http://demo.opencart.com/index.php?route=account/newsletter">Newsletter</a></li>
                    </ul>
                </div>
            </div>
            <hr>
            <p>Powered By <a href="http://www.opencart.com/">OpenCart</a><br> Your Store © 2016</p>
        </div>
    </footer>
    <div id="feedly-mini" title="feedly Mini tookit">
    </div>
    </body>
<?php $this->endBody() ?>
    </html>
<?php $this->endPage() ?>