<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\themes\opencart\OpencartAsset;
use frontend\widgets\category\CategoriesView;
use frontend\widgets\sliders\flex\FlexSlider;
use yii\helpers\Html;
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
                            <span class="hidden-xs hidden-sm hidden-md">My Account</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="<?= Url::to('user/register')?>">Register</a></li>
                            <li><a href="<?= Url::to('user/login')?>">Login</a></li>
                        </ul>
                    </li>
                    <li><a href="http://demo.opencart.com/index.php?route=account/wishlist" id="wishlist-total"
                           title="Wish List (0)"><i class="fa fa-heart"></i> <span
                                class="hidden-xs hidden-sm hidden-md">Wish List (0)</span></a></li>
                    <li><a href="http://demo.opencart.com/index.php?route=checkout/cart" title="Shopping Cart"><i
                                class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Shopping Cart</span></a>
                    </li>
                    <li><a href="http://demo.opencart.com/index.php?route=checkout/checkout" title="Checkout"><i
                                class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md">Checkout</span></a>
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
                        <input type="text" name="search" value="" placeholder="Search" class="form-control input-lg">
<span class="input-group-btn">
<button type="button" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
</span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div id="cart" class="btn-group btn-block">
                        <button type="button" data-toggle="dropdown" data-loading-text="Loading..."
                                class="btn btn-inverse btn-block btn-lg dropdown-toggle"><i
                                class="fa fa-shopping-cart"></i> <span id="cart-total">0 item(s) - $0.00</span></button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <p class="text-center">Your shopping cart is empty!</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?= CategoriesView::widget();?>
    <div class="container">
        <div class="row">
            <div id="content" class="col-sm-12">
                <?= FlexSlider::widget([
                    'items' =>[
                        Html::img('/img/velosiped1.jpg'),
                        Html::img('/img/velosiped2.jpg'),
                    ],
                ])?>
                <h3>Featured</h3>
                <div class="row product-layout">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="product-thumb transition">
                            <div class="image"><a
                                    href="http://demo.opencart.com/index.php?route=product/product&amp;product_id=43"><img
                                        src="./Your Store_files/macbook_1-200x200.jpg" alt="MacBook" title="MacBook"
                                        class="img-responsive"></a></div>
                            <div class="caption">
                                <h4>
                                    <a href="http://demo.opencart.com/index.php?route=product/product&amp;product_id=43">MacBook</a>
                                </h4>
                                <p>
                                    Intel Core 2 Duo processor
                                    Powered by an Intel Core 2 Duo processor at speeds up to 2.1..</p>
                                <p class="price">
                                    $602.00 <span class="price-tax">Ex Tax: $500.00</span>
                                </p>
                            </div>
                            <div class="button-group">
                                <button type="button" onclick="cart.add(&#39;43&#39;);"><i
                                        class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span>
                                </button>
                                <button type="button" data-toggle="tooltip" title=""
                                        onclick="wishlist.add(&#39;43&#39;);" data-original-title="Add to Wish List"><i
                                        class="fa fa-heart"></i></button>
                                <button type="button" data-toggle="tooltip" title=""
                                        onclick="compare.add(&#39;43&#39;);" data-original-title="Compare this Product">
                                    <i class="fa fa-exchange"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="product-thumb transition">
                            <div class="image"><a
                                    href="http://demo.opencart.com/index.php?route=product/product&amp;product_id=40"><img
                                        src="./Your Store_files/iphone_1-200x200.jpg" alt="iPhone" title="iPhone"
                                        class="img-responsive"></a></div>
                            <div class="caption">
                                <h4>
                                    <a href="http://demo.opencart.com/index.php?route=product/product&amp;product_id=40">iPhone</a>
                                </h4>
                                <p>
                                    iPhone is a revolutionary new mobile phone that allows you to make a call by simply
                                    tapping a nam..</p>
                                <p class="price">
                                    $123.20 <span class="price-tax">Ex Tax: $101.00</span>
                                </p>
                            </div>
                            <div class="button-group">
                                <button type="button" onclick="cart.add(&#39;40&#39;);"><i
                                        class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span>
                                </button>
                                <button type="button" data-toggle="tooltip" title=""
                                        onclick="wishlist.add(&#39;40&#39;);" data-original-title="Add to Wish List"><i
                                        class="fa fa-heart"></i></button>
                                <button type="button" data-toggle="tooltip" title=""
                                        onclick="compare.add(&#39;40&#39;);" data-original-title="Compare this Product">
                                    <i class="fa fa-exchange"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="product-thumb transition">
                            <div class="image"><a
                                    href="http://demo.opencart.com/index.php?route=product/product&amp;product_id=42"><img
                                        src="./Your Store_files/apple_cinema_30-200x200.jpg" alt="Apple Cinema 30&quot;"
                                        title="Apple Cinema 30&quot;" class="img-responsive"></a></div>
                            <div class="caption">
                                <h4>
                                    <a href="http://demo.opencart.com/index.php?route=product/product&amp;product_id=42">Apple
                                        Cinema 30"</a></h4>
                                <p>
                                    The 30-inch Apple Cinema HD Display delivers an amazing 2560 x 1600 pixel
                                    resolution. Designed sp..</p>
                                <p class="price">
                                    <span class="price-new">$110.00</span> <span class="price-old">$122.00</span>
                                    <span class="price-tax">Ex Tax: $90.00</span>
                                </p>
                            </div>
                            <div class="button-group">
                                <button type="button" onclick="cart.add(&#39;42&#39;);"><i
                                        class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span>
                                </button>
                                <button type="button" data-toggle="tooltip" title=""
                                        onclick="wishlist.add(&#39;42&#39;);" data-original-title="Add to Wish List"><i
                                        class="fa fa-heart"></i></button>
                                <button type="button" data-toggle="tooltip" title=""
                                        onclick="compare.add(&#39;42&#39;);" data-original-title="Compare this Product">
                                    <i class="fa fa-exchange"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="product-thumb transition">
                            <div class="image"><a
                                    href="http://demo.opencart.com/index.php?route=product/product&amp;product_id=30"><img
                                        src="./Your Store_files/canon_eos_5d_1-200x200.jpg" alt="Canon EOS 5D"
                                        title="Canon EOS 5D" class="img-responsive"></a></div>
                            <div class="caption">
                                <h4>
                                    <a href="http://demo.opencart.com/index.php?route=product/product&amp;product_id=30">Canon
                                        EOS 5D</a></h4>
                                <p>
                                    Canon's press material for the EOS 5D states that it 'defines (a) new D-SLR
                                    category', while we'r..</p>
                                <p class="price">
                                    <span class="price-new">$98.00</span> <span class="price-old">$122.00</span>
                                    <span class="price-tax">Ex Tax: $80.00</span>
                                </p>
                            </div>
                            <div class="button-group">
                                <button type="button" onclick="cart.add(&#39;30&#39;);"><i
                                        class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span>
                                </button>
                                <button type="button" data-toggle="tooltip" title=""
                                        onclick="wishlist.add(&#39;30&#39;);" data-original-title="Add to Wish List"><i
                                        class="fa fa-heart"></i></button>
                                <button type="button" data-toggle="tooltip" title=""
                                        onclick="compare.add(&#39;30&#39;);" data-original-title="Compare this Product">
                                    <i class="fa fa-exchange"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="carousel0" class="flexslider carousel">

                    <div class="flex-viewport" style="overflow: hidden; position: relative;">
                        <ul class="slides"
                            style="width: 2200%; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);">
                            <li style="width: 208px; float: left; display: block;"><img
                                    src="./Your Store_files/cocacola-130x100.png" alt="Coca Cola" class="img-responsive"
                                    draggable="false"></li>
                            <li style="width: 208px; float: left; display: block;"><img
                                    src="./Your Store_files/nintendo-130x100.png" alt="Nintendo" class="img-responsive"
                                    draggable="false"></li>
                            <li style="width: 208px; float: left; display: block;"><img
                                    src="./Your Store_files/burgerking-130x100.png" alt="Burger King"
                                    class="img-responsive" draggable="false"></li>
                            <li style="width: 208px; float: left; display: block;"><img
                                    src="./Your Store_files/starbucks-130x100.png" alt="Starbucks"
                                    class="img-responsive" draggable="false"></li>
                            <li style="width: 208px; float: left; display: block;"><img
                                    src="./Your Store_files/canon-130x100.png" alt="Canon" class="img-responsive"
                                    draggable="false"></li>
                            <li style="width: 208px; float: left; display: block;"><img
                                    src="./Your Store_files/sony-130x100.png" alt="Sony" class="img-responsive"
                                    draggable="false"></li>
                            <li style="width: 208px; float: left; display: block;"><img
                                    src="./Your Store_files/redbull-130x100.png" alt="RedBull" class="img-responsive"
                                    draggable="false"></li>
                            <li style="width: 208px; float: left; display: block;"><img
                                    src="./Your Store_files/nfl-130x100.png" alt="NFL" class="img-responsive"
                                    draggable="false"></li>
                            <li style="width: 208px; float: left; display: block;"><img
                                    src="./Your Store_files/harley-130x100.png" alt="Harley Davidson"
                                    class="img-responsive" draggable="false"></li>
                            <li style="width: 208px; float: left; display: block;"><img
                                    src="./Your Store_files/dell-130x100.png" alt="Dell" class="img-responsive"
                                    draggable="false"></li>
                            <li style="width: 208px; float: left; display: block;"><img
                                    src="./Your Store_files/disney-130x100.png" alt="Disney" class="img-responsive"
                                    draggable="false"></li>
                        </ul>
                    </div>
                    <ol class="flex-control-nav flex-control-paging">
                        <li><a class="flex-active">1</a></li>
                        <li><a class="">2</a></li>
                        <li><a class="">3</a></li>
                    </ol>
                    <ul class="flex-direction-nav">
                        <li><a class="flex-prev" href="http://demo.opencart.com/#">Previous</a></li>
                        <li><a class="flex-next" href="http://demo.opencart.com/#">Next</a></li>
                    </ul>
                </div>
                <script type="text/javascript"><!--
                    $(window).load(function () {
                        $('#carousel0').flexslider({
                            animation: 'slide',
                            itemWidth: 130,
                            itemMargin: 100,
                            minItems: 2,
                            maxItems: 4
                        });
                    });
                    --></script>
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