<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\themes\opencart\OpencartAsset;
use frontend\widgets\breadcrumb\Breadcrumbs;
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
                        <a href="<?= Url::to('/')?>"><img src="<?= $basicAsset->getLogo()?>" title="Your Store" alt="Your Store" class="img-responsive"></a>
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
        <?= Breadcrumbs::widget();?>
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
                    <div class="inside-padd">
                        <a href="" class="logo">
                            <img src="<?= $basicAsset->getLogo()?>" alt="logo">
                        </a>
                        <ul style="list-style: none;">
                            <li><span class="f-s_16">(800) 568 56 56</span></li>
                            <li><span class="f-s_16">(800) 568 56 56</span></li>
                            <li>Звоните с 09:00 до 18:00</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <h5>Информация</h5>
                    <ul class="list-unstyled">
                        <li><a href="" title="О компании">О компании</a></li>
                        <li><a href="" title="Оптовым покупателям">Оптовым покупателям</a></li>
                        <li><a href="" title="Доставка и оплата">Доставка и оплата</a></li>
                        <li><a href="" title="Гарантии">Гарантии</a></li>
                        <li><a href="" title="Новости">Новости</a></li>
                        <li><a href="" title="Бренды">Бренды</a></li>
                        <li><a href="" title="Контакты">Контакты</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5>Наши преимущества</h5>
                    <ul class="list-unstyled">
                        <li>Быстрая доставка</li>
                        <li>Гибкая система скидок</li>
                        <li>Полезная консультация</li>
                        <li>Качественный сервис</li>
                        <li>Широкий ассортимент</li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h5></h5>
                    <ul class="list-unstyled">
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