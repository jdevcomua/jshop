<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use app\assets\AppAsset;

?>
<!-- -->
<html><head>
        <meta charset="utf-8">
    <?= Html::csrfMetaTags() ?>
        <title>active</title>
        <link rel="stylesheet" type="text/css" href="http://active.imagecmsdemo.net/templates/active/css/style.css" media="all">
        <link rel="stylesheet" type="text/css" href="http://active.imagecmsdemo.net/templates/active/css/color_scheme_1/colorscheme.css" media="all">
        <link rel="stylesheet" type="text/css" href="http://active.imagecmsdemo.net/templates/active/css/color_scheme_1/color.css" media="all">

                        <script type="text/javascript">
            var locale = "";
        </script>
        <script type="text/javascript" src="http://active.imagecmsdemo.net/templates/active/js/jquery-1.8.3.min.js"></script>
        <!-- php vars to js -->
            <script type="text/javascript">
                    var curr = '$',
            cartItemsProductsId = null,
            nextCs = 'руб',
            nextCsCond = nextCs == '' ? false : true,
            pricePrecision = parseInt(''),
            checkProdStock = "", //use in plugin plus minus
            inServerCompare = parseInt("0"),
            inServerWishList = parseInt("0"),
            countViewProd = parseInt("0"),
            theme = "http://active.imagecmsdemo.net/templates/active/",
            siteUrl = "http://active.imagecmsdemo.net/",
            colorScheme = "css/color_scheme_1",
            isLogin = "0" === '1' ? true : false,
            typePage = "shop_category",
            typeMenu = "row";

</script>
        <script type="text/javascript" src="http://active.imagecmsdemo.net/templates/active/js/settings.js"></script>
        <!--[if lte IE 9]><script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="http://active.imagecmsdemo.net/templates/active/css/lte_ie_8.css" /><![endif]-->
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="http://active.imagecmsdemo.net/templates/active/css/ie_7.css" />
            <script src="http://active.imagecmsdemo.net/templates/active/js/localStorageJSON.js"></script>
        <![endif]-->

        <link rel="icon" href="/uploads/images/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="/uploads/images/favicon.ico" type="image/x-icon">
    <link data-arr="8" rel="stylesheet" type="text/css" href="http://active.imagecmsdemo.net/templates/active/star_rating/css/style.css">
<style type="text/css">

</style></head>

    <body class="isChrome shop_category notTouch"> 
        <script>
    var langs = new Object();
        function lang(value) {
            return  langs[value] ? langs[value] : value;
        }

</script>
        <div class="main-body">
                <div class="fon-header">
                    <header>
                        <div class="content-header">
    <div class="container">
        <!--        Logo-->
                <a href="" class="logo">
            <img src="http://active.imagecmsdemo.net/uploads/images/logo.png" alt="logo">
        </a>
                <div class="left-content-header">
            <div class="header-left-content-header t-a_j">
                <!--                Start. contacts block-->
                <div class="phones-header">
                    <div class="f-s_0 d_i-b v-a_b">
                        <span class="icon_phone_header"></span>
                        <span class="phone f-s_0">
                            <span class="phone-number">(800) 568 56 56</span>
                            <span class="phone-number">(800) 568 56 56</span>
                        </span>
                    </div>
                    <div class="btn-order-call v-a_b">
                        <button data-drop="#ordercall" data-tab="true" data-source="http://active.imagecmsdemo.net/shop/callback" class="isDrop">
                            <span class="icon_order_call"></span>
                            <span class="text-el ref-2"></span>
                        </button>
                    </div>
                </div>
                <!--End. Contacts block-->
                <div class="d_i-b f-s_0 f0I">
                    <nav class="d_i-b v-a_m">
                        <ul class="nav nav-top-menu">
                            
<li>
            <button type="button" title="Магазин" data-drop-filter="next()" class="isDrop">
            Магазин            <span class="icon-arrow-d"></span>
        </button>
        <ul class="sub-menu"><li><a href="http://active.imagecmsdemo.net/o-magazine" target="_self" title="О магазине">О магазине</a></li>

<li><a href="http://active.imagecmsdemo.net/dostavka" target="_self" title="Доставка">Доставка</a></li>

<li><a href="http://active.imagecmsdemo.net/oplata" target="_self" title="Оплата">Оплата</a></li>

</ul>    </li>

<li>
            <a href="http://active.imagecmsdemo.net/novosti" target="_self" title="Новости">
            Новости        </a>
    </li>

<li>
            <a href="http://active.imagecmsdemo.net/kontakty" target="_self" title="Контакты">
            Контакты        </a>
    </li>

                        </ul>
                    </nav>
                    <div class="d_i-b v-a_m">
                        <nav>
    <ul class="nav nav-enter-reg">
                    <li class="btn-enter-register">
                    <span class="text-el">

                    </span>
            </li>
            </ul>
</nav>                    </div>
                </div>
            </div>
            <div class="frame-search-cleaner">
                <!--                Start. Include cart data template-->
                <div id="tinyBask" class="frame-cleaner">
                    
    <div class="btn-bask">
        <button>
            <span class="icon_cleaner"></span>
            <span class="text-cleaner">
                <span class="text-el">Корзина пуста</span>
            </span>
        </button>
    </div>
                </div>
                <!--                    End. Include cart data template-->
                <!--                Start. Show search form-->
                <div class="frame-search-form">
                    <div class="p_r">
                        <form name="search" method="get" action="">
                            <span class="btn-search">
                                <button type="submit"><span class="text-el">Поиск</span></button>
                            </span>
                            <div class="frame-search-input">
                                <span class="icon_search"></span>
                                <input type="text" class="input-search" id="inputString" name="search" autocomplete="off" value="" placeholder="Я ищу">
                                <div id="suggestions" class="drop drop-search"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--                End. Show search form-->
            </div>
        </div>
    </div>
</div>
                    </header>
                    <?php echo $content; ?>
        <footer>
            <div class="content-footer">
  <div class="container">
    <div class="box-1">
      <div class="inside-padd">

                <a href="" class="logo">
          <img src="http://active.imagecmsdemo.net/uploads/images/logo.png" alt="logo">
        </a>
                <ul> 
           <li><span class="f-s_16">(800) 568 56 56</span></li>               
          <li><span class="f-s_16">(800) 568 56 56</span></li>          <li>Звоните с 09:00 до 18:00</li>        </ul>

      </div>

    </div>
    <div class="box-3">
      <div class="inside-padd">
        <div class="main-title">Информация</div>
        <ul class="nav nav-vertical">
          
<li><a href="" title="О компании">О компании</a></li>

<li><a href="" title="Оптовым покупателям">Оптовым покупателям</a></li>

<li><a href="" title="Доставка и оплата">Доставка и оплата</a></li>

<li><a href="" title="Гарантии">Гарантии</a></li>

<li><a href="" title="Новости">Новости</a></li>

<li><a href="" title="Бренды">Бренды</a></li>

<li><a href="" title="Контакты">Контакты</a></li>

        </ul>
      </div>
    </div>
    <div class="box-4">
      <div class="inside-padd">
        <div class="main-title">наши преимущества</div>
        <ul>
<li>Быстрая доставка</li>
<li>Гибкая система скидок</li>
<li>Полезная консультация</li>
<li>Качественный сервис</li>
<li>Широкий ассортимент</li>
</ul>      </div>

    </div>
    <div class="box-5">
      <div class="inside-padd">
        <div class="main-title">Контакты</div>
        <ul class="items-contacts">
          <li>info@active.com</li>                  
          <li>active.com</li>          <li>Aдрес: ул. Солнечная, 85 Oфис 305</li>        </ul>
      </div>

    </div>
  </div>
</div>
<div class="footer-footer">
  <div class="container">
    <div class="t-a_j">
      <div class="d_i-b v-a_m">
        <div> © «Active»  2015 Все права защищены</div>
      </div>
      <div class="engine">
      </div>
    </div>
  </div>
</div>
        </footer>

        <script type="text/javascript">
            initDownloadScripts(['united_scripts'], 'init', 'scriptDefer');
        </script>

                <button type="button" id="showCartPopup" data-drop="#popupCart" style="display: none;" class="isDrop"></button>
<div class="drop-bask drop drop-style" id="popupCart"></div>
    <div id="fancybox-loading"><div></div></div><div id="fancybox-loading"><div></div></div></body></html>
