<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $category \common\models\ItemCat */
?>

<div class="content">
    <br>
    <div class="frame-inside page-category">
        <div class="container">
            <div class="left-start-page">
                <div class="frame-baner frame-baner-start_page" style="height: 270px;">
                    <style>
                        #owl-demo .item img{
                            display: block;
                            width: 100%;
                            height: auto;
                        }
                    </style>
                    <div id="demo">
                        <div class="container">
                            <div class="row">
                                <div class="span12">
                                    <div id="owl-demo" class="owl-carousel">
                                        <?php foreach (\common\models\Stock::getCurrent()->all() as $stock) {
                                            /* @var $stock \common\models\Stock*/
                                            ?>
                                            <div class="item" align="center">
                                                <a href="<?php echo Yii::$app->urlHelper->to(['promotion/' . $stock->id]); ?>">
                                                    <img style="max-height: 227px;width:initial;"
                                                        src="<?php echo $stock->getImageUrl(); ?>">
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $("#owl-demo").owlCarousel({

                                navigation : false,
                                slideSpeed : 500,
                                paginationSpeed : 500,
                                singleItem : true,
                                autoPlay: 5000,
                                stopOnHover: true

                            });
                        });
                    </script>
                </div>
                <div id="new_products" style="margin-top: 4px;">
                    <div class="horizontal-carousel">
                        <section class="special-proposition">
                            <div class="title-proposition-h">
                                <div class="frame-title">
                                    <div class="title">мы рекомендуем</div>
                                </div>
                            </div>
                            <div class="big-container">
                                <div class="items-carousel">
                                    <div class="content-carousel container">
                                        <ul class="items items-catalog items-h-carousel">
                                            <?php foreach ($items as $item) {
                                                /* @var $item \common\models\Item */
                                                ?>
                                                <li class="globalFrameProduct to-cart" style="padding-bottom: 5px;" data-pos="top">
                                                    <!-- Start. Photo & Name product -->
                                                    <a href="<?php echo Yii::$app->urlHelper->to(['item/' . $item->id . '-' . $item->getTranslit()]); ?>"
                                                       class="frame-photo-title">
                                                        <span class="photo-block">
                                                            <span class="helper"></span>
                                                            <img src="<?php echo array_shift($item->getImageUrl()); ?>">
                                                            <span class="product-status nowelty"></span>
                                                        </span>
                                                        <span class="title"><?php echo $item->title; ?></span>
                                                    </a>
                                                    <!-- End. Photo & Name product -->
                                                    <div class="description">
                                                        <!-- Start. Star rating -->
                                                        <?php if ($item->getAvgRating()['avg'] != 0) { ?>
                                                            <script src="http://www.radioactivethinking.com/rateit/src/jquery.rateit.js" type="text/javascript"></script>                                    <div class="mark-pr">
                                                                <span class="title"><?php //echo \Yii::t('app', 'Оценка товара:'); ?></span>
                                                                <div class="rateit" data-rateit-value="<?php echo $item->getAvgRating()['avg']; ?>"
                                                                     data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                                                (<?php echo $item->getAvgRating()['count']; ?>)
                                                            </div>
                                                        <?php } ?>
                                                        <!-- End. Star rating-->
                                                        <div class="frame-prices-buttons">
                                                            <!-- Start. Prices-->
                                                            <div class="frame-prices f-s_0">
                                                                <!-- Start. Product price-->
                                                                <span class="current-prices f-s_0">
                                                                    <span class="price-new"><span>
                                                                        <span class="price priceVariant">
                                                                            <?php echo $item->existDiscount() ? $item->getNewPrice() : $item->cost; ?> </span> грн. </span>
                                                                    </span>
                                                                </span>
                                                                <!-- End. Product price-->
                                                            </div>
                                                            <!-- End. Prices-->
                                                            <div class="f-s_0 m-b_10">
                                                                <div class="funcs-buttons">
                                                                    <!-- Start. Collect information about Variants, for future processing -->
                                                                    <div class="frame-count-buy js-variant-17906 js-variant">
                                                                        <?php if (Yii::$app->cart->checkItemInCart($item->id)) { ?>
                                                                            <div id="inCart-<?php echo $item->id ?>" class="btn-buy btn-cart">
                                                                                <a href="<?php echo Yii::$app->urlHelper->to(['cart']) ?>"
                                                                                   style="padding: 0 9px 0 7px;">
                                                                                    <button type="button" class="btnBuy"
                                                                                            style="padding-top: 8px;">
                                                                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                                        <span class="text-el">В корзине</span>
                                                                                    </button>
                                                                                </a>
                                                                            </div>
                                                                        <?php } else { ?>
                                                                            <div id="inCart-<?php echo $item->id ?>"
                                                                                 class="btn-buy btn-cart d_n">
                                                                                <a href="<?php echo Yii::$app->urlHelper->to(['cart']) ?>"
                                                                                   style="padding: 0 9px 0 7px;">
                                                                                    <button type="button" class="btnBuy"
                                                                                            style="padding-top: 8px;">
                                                                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                                        <span class="text-el">В корзине</span>
                                                                                    </button>
                                                                                </a>
                                                                            </div>
                                                                            <div id="toCart-<?php echo $item->id ?>" class="btn-buy">
                                                                                <button type="button" class="btnBuy infoBut" onclick="addToCart(<?php echo $item->id ?>)">
                                                                                    <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                                    <span class="text-el">Купить</span>
                                                                                </button>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>

                                                                </div>
                                                                <!-- End. Collect information about Variants, for future processing -->
                                                                <!-- Wish List & Compare List buttons -->
                                                                <div class="frame-wish-compare-list f-s_0">
                                                                    <div class="frame-btn-comp">
                                                                        <!-- Start. Compare List button-->
                                                                        <?php if (!Yii::$app->compare->existInList($item->id)) { ?>
                                                                            <div id="toCompare" class="btn-compare">
                                                                                <button class="toCompare" type="button" data-title="В список сравнений"
                                                                                        onclick="addToCompareList(<?php echo $item->id; ?>, $(this))" >
                                                                                    <span class="icon_compare"></span>
                                                                                    <span class="text-el d_l">В список сравнений</span>
                                                                                </button>
                                                                            </div>
                                                                            <div id="inCompare" class="btn-compare btn-comp-in d_n">
                                                                                <a href="<?php echo Yii::$app->urlHelper->to(['compare/compare']); ?>"
                                                                                   style="padding-top: 8px; padding-bottom: 9px;"><button class="toCompare" type="button" data-title="В список сравнений">
                                                                                        <span class="icon_compare"></span>
                                                                                        <span class="text-el d_l">В список сравнений</span>
                                                                                    </button></a>
                                                                            </div>
                                                                        <?php } else { ?>
                                                                            <div class="btn-compare btn-comp-in">
                                                                                <a href="<?php echo Yii::$app->urlHelper->to(['compare/compare']); ?>"
                                                                                   style="padding-top: 8px; padding-bottom: 9px;"><button class="toCompare" type="button" data-title="В список сравнений">
                                                                                        <span class="icon_compare"></span>
                                                                                        <span class="text-el d_l">В список сравнений</span>
                                                                                    </button></a>
                                                                            </div>
                                                                        <?php } ?>
                                                                        <!-- End. Compare List button -->
                                                                    </div>
                                                                    <!-- Start. Wish list buttons -->
                                                                    <div class="frame-btn-wish js-variant-17906 js-variant d_i-b_">
                                                                        <div class="btnWish btn-wish">
                                                                            <?php if ($item->inWishList()) { ?>
                                                                                <button id="inwish-<?php echo $item->id; ?>" class="inWishlist"
                                                                                        data-title="В списке желаний">
                                                                                    <a href="<?php echo Yii::$app->urlHelper->to(['profile']) ?>">
                                                                <span class="icon_wish"
                                                                      style="background-position: -160px 0;"></span>
                                                                                        <span class="text-el d_l">В списке желания</span>
                                                                                    </a>
                                                                                </button>
                                                                            <?php } else { ?>
                                                                                <button id="towish-<?php echo $item->id; ?>" class="toWishlist"
                                                                                        onclick="
                                                                                            openWishWindow(<?php echo Yii::$app->user->isGuest ? 1 : 0; ?>, <?php echo $item->id; ?>);
                                                                                            "><span class="icon_wish"></span>
                                                                                    <span class="text-el d_l">В желаемое</span>
                                                                                </button>
                                                                                <button id="inwish-<?php echo $item->id; ?>"
                                                                                        class="inWishlist d_n"
                                                                                        data-title="В списке желаний">
                                                                                    <a href="<?php echo Yii::$app->urlHelper->to(['profile']) ?>">
                                                                <span class="icon_wish"
                                                                      style="background-position: -160px 0;"></span>
                                                                                        <span class="text-el d_l">В списке желания</span>
                                                                                    </a>
                                                                                </button>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End. wish list buttons -->
                                                                </div>
                                                                <!-- End. Wish List & Compare List buttons -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Start. Remove buttons if compare-->
                                                    <!-- End. Remove buttons if compare-->

                                                    <!-- Start. For wishlist page-->
                                                    <!-- End. For wishlist page-->

                                                    <div class="decor-element"></div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="group-button-carousel">
                                        <button type="button" class="prev arrow">
                                            <span class="icon_arrow_p"></span>
                                        </button>
                                        <button type="button" class="next arrow">
                                            <span class="icon_arrow_n"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                </div>

            </div>
            <div class="right-start-page">
                <div class="frame-little-banner">
                    <p>
                        <a href="http://active.imagecmsdemo.net/dostavka"><img
                                src="http://active.imagecmsdemo.net/uploads/shop/banners/banner_small.jpg" alt=""></a>
                    </p>
                </div>
                <div id="action_products">
                    <div class="vertical-carousel">
                        <section class="special-proposition">
                            <div class="title-proposition-v">
                                <div class="frame-title">
                                    <div class="title">Цена недели</div>
                                </div>
                            </div>
                            <div class="big-container">
                                <div class="frame-baner frame-baner-start_page" style="padding-bottom: 5px;">
                                    <style>
                                        #owl-demo1 .item img{
                                            width: initial;
                                            height: 200px;
                                        }
                                        .frame-photo-title{
                                            text-decoration: none;
                                        }
                                        .photo-block {
                                            width: 200px;
                                            height: 160px;
                                            padding: 7px;
                                        }
                                    </style>
                                    <div id="demo">
                                        <div class="container">
                                            <div class="row">
                                                <div class="span12">
                                                    <div id="owl-demo1" class="owl-carousel">
                                                        <?php foreach (\common\models\Stock::getThreeItems()->all() as $value) {
                                                            /* @var $value \common\models\Item*/
                                                            ?>
                                                            <div class="item" align="center" ><div style="margin: 0px; width: 217px !important; height: 260px;">
                                                                    <a href="<?php echo Yii::$app->urlHelper->to(['item/' . $value->id . '-' . $value->getTranslit()]); ?>"
                                                                       class="frame-photo-title">
                                <div class="photo-block" align="center"><img
                                        src="<?php echo array_shift($value->getImageUrl()); ?>">
                                    <?php if ($value->existDiscount()) { ?>
                                        <span class="product-status action"></span>
                                    <?php } ?>
                                </div>
                                                                        <span class="title"><?php echo $value['title']; ?></span></a>
                                                                    <div class="description">
                                                                        <!-- Start. Star rating -->
                                                                        <?php if ($value->getAvgRating()['avg'] != 0) { ?>
                                                                            <script src="http://www.radioactivethinking.com/rateit/src/jquery.rateit.js" type="text/javascript"></script>                                    <div class="mark-pr">
                                                                                <span class="title"><?php //echo \Yii::t('app', 'Оценка товара:'); ?></span>
                                                                                <div class="rateit" data-rateit-value="<?php echo $value->getAvgRating()['avg']; ?>"
                                                                                     data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                                                                (<?php echo $value->getAvgRating()['count']; ?>)
                                                                            </div>
                                                                        <?php } ?>
                                                                        <!-- End. Star rating-->
                                                                        <div class="frame-prices-buttons">
                                                                            <div class="frame-prices f-s_0">
                                                                                <!-- Start. Check old price-->
                                                                                <?php if ($value->existDiscount()) { ?>
                                                                                    <span class="price-discount"><span>
                                                    <span class="price priceOrigVariant" style="display: inline;"><?php echo $value->cost; ?></span> грн.</span>
                                                </span>
                                                                                <?php } ?>
                                                                                <!-- End. Check old price-->
                                                                                <!-- Start. Product price-->
                                            <span class="current-prices f-s_0">
                                                <span class="price-new"><span>
                                                    <span class="price priceVariant"><?php echo $value->existDiscount() ? $value->getNewPrice() : $value->cost; ?> </span> грн. </span>
                                                </span>
                                            </span>
                                                                                <!-- End. Product price-->
                                                                            </div>
                                                                            <div class="f-s_0 m-b_10">
                                                                                <div class="funcs-buttons">
                                                                                    <!-- Start. Collect information about Variants, for future processing -->
                                                                                    <div class="frame-count-buy js-variant-17906 js-variant" style="    margin-right: 5px;">
                                                                                        <?php if (Yii::$app->cart->checkItemInCart($value->id)) { ?>
                                                                                            <div id="inCart-<?php echo $value->id ?>" class="btn-buy btn-cart">
                                                                                                <a href="<?php echo Yii::$app->urlHelper->to(['cart']) ?>"
                                                                                                   style="padding: 0 9px 0 7px;">
                                                                                                    <button type="button" class="btnBuy"
                                                                                                            style="padding-top: 8px;">
                                                                                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                                                    </button>
                                                                                                </a>
                                                                                            </div>
                                                                                        <?php } else { ?>
                                                                                            <div id="inCart-<?php echo $value->id ?>"
                                                                                                 class="btn-buy btn-cart d_n">
                                                                                                <a href="<?php echo Yii::$app->urlHelper->to(['cart']) ?>"
                                                                                                   style="padding: 0 9px 0 7px;">
                                                                                                    <button type="button" class="btnBuy"
                                                                                                            style="padding-top: 8px;">
                                                                                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                                                    </button>
                                                                                                </a>
                                                                                            </div>
                                                                                            <div id="toCart-<?php echo $value->id ?>" class="btn-buy">
                                                                                                <button type="button" class="btnBuy infoBut" onclick="addToCart(<?php echo $value->id ?>)">
                                                                                                    <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                                                </button>
                                                                                            </div>
                                                                                        <?php } ?>
                                                                                    </div>

                                                                                </div>
                                                                                <!-- End. Collect information about Variants, for future processing -->
                                                                                <!-- Wish List & Compare List buttons -->
                                                                                <div class="frame-wish-compare-list f-s_0">
                                                                                    <div class="frame-btn-comp">
                                                                                        <!-- Start. Compare List button-->
                                                                                        <?php if (!Yii::$app->compare->existInList($value->id)) { ?>
                                                                                            <div id="toCompare" class="btn-compare">
                                                                                                <button class="toCompare" type="button" data-title="В список сравнений"
                                                                                                        onclick="addToCompareList(<?php echo $value->id; ?>, $(this))" >
                                                                                                    <span class="icon_compare"></span>
                                                                                                    <span class="text-el d_l">В список сравнений</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div id="inCompare" class="btn-compare btn-comp-in d_n">
                                                                                                <a href="<?php echo Yii::$app->urlHelper->to(['compare/compare']); ?>"
                                                                                                   style="padding-top: 8px; padding-bottom: 9px;"><button class="toCompare" type="button" data-title="В список сравнений">
                                                                                                        <span class="icon_compare"></span>
                                                                                                        <span class="text-el d_l">В список сравнений</span>
                                                                                                    </button></a>
                                                                                            </div>
                                                                                        <?php } else { ?>
                                                                                            <div class="btn-compare btn-comp-in">
                                                                                                <a href="<?php echo Yii::$app->urlHelper->to(['compare/compare']); ?>"
                                                                                                   style="padding-top: 8px; padding-bottom: 9px;"><button class="toCompare" type="button" data-title="В список сравнений">
                                                                                                        <span class="icon_compare"></span>
                                                                                                        <span class="text-el d_l">В список сравнений</span>
                                                                                                    </button></a>
                                                                                            </div>
                                                                                        <?php } ?>
                                                                                        <!-- End. Compare List button -->
                                                                                    </div>
                                                                                    <!-- Start. Wish list buttons -->
                                                                                    <div class="frame-btn-wish js-variant-17906 js-variant d_i-b_">
                                                                                        <div class="btnWish btn-wish">
                                                                                            <?php if ($value->inWishList()) { ?>
                                                                                                <button id="inwish-<?php echo $value->id; ?>" class="inWishlist"
                                                                                                        data-title="В списке желаний">
                                                                                                    <a href="<?php echo Yii::$app->urlHelper->to(['profile']) ?>">
                                                                <span class="icon_wish"
                                                                      style="background-position: -160px 0;"></span>
                                                                                                        <span class="text-el d_l">В списке желания</span>
                                                                                                    </a>
                                                                                                </button>
                                                                                            <?php } else { ?>
                                                                                                <button id="towish-<?php echo $value->id; ?>" class="toWishlist"
                                                                                                        onclick="
                                                                                                            openWishWindow(<?php echo Yii::$app->user->isGuest ? 1 : 0; ?>, <?php echo $value->id; ?>);
                                                                                                            "><span class="icon_wish"></span>
                                                                                                    <span class="text-el d_l">В желаемое</span>
                                                                                                </button>
                                                                                                <button id="inwish-<?php echo $value->id; ?>"
                                                                                                        class="inWishlist d_n"
                                                                                                        data-title="В списке желаний">
                                                                                                    <a href="<?php echo Yii::$app->urlHelper->to(['profile']) ?>">
                                                                <span class="icon_wish"
                                                                      style="background-position: -160px 0;"></span>
                                                                                                        <span class="text-el d_l">В списке желания</span>
                                                                                                    </a>
                                                                                                </button>
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- End. wish list buttons -->
                                                                                </div>
                                                                                <!-- End. Wish List & Compare List buttons -->
                                                                            </div>
                                                                            <div class="decor-element"
                                                                                 style="height: 281px; width: 100%; position: absolute; right: auto; left: 0px; bottom: auto; top: 0px;">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    $("#owl-demo1").owlCarousel({

                                                        navigation : false,
                                                        slideSpeed : 500,
                                                        paginationSpeed : 500,
                                                        singleItem : true,
                                                        autoPlay: 5000,
                                                        stopOnHover: true,
                                                        baseClass: 'owl-carousel1',
                                                        autoHeight: true

                                                    });
                                                });
                                            </script>
                                        </div>

                                    </div>

                                </div>
                                </div>
                        </section>
                    </div>
                </div>
                <div id="action_products">
                    <div class="vertical-carousel">
                        <section class="special-proposition">
                            <div class="title-proposition-v">
                                <div class="frame-title">
                                    <div class="title">Топ продаж</div>
                                </div>
                            </div>
                            <div class="big-container">
                                <div class="frame-baner frame-baner-start_page" style="padding-bottom: 5px;">
                                    <style>
                                        #owl-demo2 .item img{
                                            width: initial;
                                            height: 200px;
                                        }
                                        .frame-photo-title{
                                            text-decoration: none;
                                        }
                                        .photo-block {
                                            width: 200px;
                                            height: 160px;
                                            padding: 7px;
                                        }
                                    </style>
                                    <div id="demo">
                                        <div class="container">
                                            <div class="row">
                                                <div class="span12">
                                                    <div id="owl-demo2" class="owl-carousel">
                                                        <?php foreach (\common\models\Item::getTop()->all() as $value) {
                                                            /* @var $value \common\models\Item*/
                                                            ?>
                                                            <div class="item" align="center" ><div style="margin: 0px; width: 217px !important; height: 260px;">
                                                                    <a href="<?php echo Yii::$app->urlHelper->to(['item/' . $value->id . '-' . $value->getTranslit()]); ?>"
                                                                       class="frame-photo-title">
                                                                        <div class="photo-block" align="center"><img
                                                                                src="<?php echo array_shift($value->getImageUrl()); ?>">
                                                                                <span class="product-status hit"></span>
                                                                        </div>
                                                                        <span class="title"><?php echo $value['title']; ?></span></a>
                                                                    <div class="description">
                                                                        <!-- Start. Star rating -->
                                                                        <?php if ($value->getAvgRating()['avg'] != 0) { ?>
                                                                            <script src="http://www.radioactivethinking.com/rateit/src/jquery.rateit.js" type="text/javascript"></script>                                    <div class="mark-pr">
                                                                                <span class="title"><?php //echo \Yii::t('app', 'Оценка товара:'); ?></span>
                                                                                <div class="rateit" data-rateit-value="<?php echo $value->getAvgRating()['avg']; ?>"
                                                                                     data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                                                                (<?php echo $value->getAvgRating()['count']; ?>)
                                                                            </div>
                                                                        <?php } ?>
                                                                        <!-- End. Star rating-->
                                                                        <div class="frame-prices-buttons">
                                                                            <div class="frame-prices f-s_0">
                                                                                <!-- Start. Check old price-->
                                                                                <?php if ($value->existDiscount()) { ?>
                                                                                    <span class="price-discount"><span>
                                                    <span class="price priceOrigVariant" style="display: inline;"><?php echo $value->cost; ?></span> грн.</span>
                                                </span>
                                                                                <?php } ?>
                                                                                <!-- End. Check old price-->
                                                                                <!-- Start. Product price-->
                                            <span class="current-prices f-s_0">
                                                <span class="price-new"><span>
                                                    <span class="price priceVariant"><?php echo $value->existDiscount() ? $value->getNewPrice() : $value->cost; ?> </span> грн. </span>
                                                </span>
                                            </span>
                                                                                <!-- End. Product price-->
                                                                            </div>
                                                                            <div class="f-s_0 m-b_10">
                                                                                <div class="funcs-buttons">
                                                                                    <!-- Start. Collect information about Variants, for future processing -->
                                                                                    <div class="frame-count-buy js-variant-17906 js-variant" style="    margin-right: 5px;">
                                                                                        <?php if (Yii::$app->cart->checkItemInCart($value->id)) { ?>
                                                                                            <div id="inCart-<?php echo $value->id ?>" class="btn-buy btn-cart">
                                                                                                <a href="<?php echo Yii::$app->urlHelper->to(['cart']) ?>"
                                                                                                   style="padding: 0 9px 0 7px;">
                                                                                                    <button type="button" class="btnBuy"
                                                                                                            style="padding-top: 8px;">
                                                                                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                                                    </button>
                                                                                                </a>
                                                                                            </div>
                                                                                        <?php } else { ?>
                                                                                            <div id="inCart-<?php echo $value->id ?>"
                                                                                                 class="btn-buy btn-cart d_n">
                                                                                                <a href="<?php echo Yii::$app->urlHelper->to(['cart']) ?>"
                                                                                                   style="padding: 0 9px 0 7px;">
                                                                                                    <button type="button" class="btnBuy"
                                                                                                            style="padding-top: 8px;">
                                                                                                        <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                                                    </button>
                                                                                                </a>
                                                                                            </div>
                                                                                            <div id="toCart-<?php echo $value->id ?>" class="btn-buy">
                                                                                                <button type="button" class="btnBuy infoBut" onclick="addToCart(<?php echo $value->id ?>)">
                                                                                                    <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                                                </button>
                                                                                            </div>
                                                                                        <?php } ?>
                                                                                    </div>

                                                                                </div>
                                                                                <!-- End. Collect information about Variants, for future processing -->
                                                                                <!-- Wish List & Compare List buttons -->
                                                                                <div class="frame-wish-compare-list f-s_0">
                                                                                    <div class="frame-btn-comp">
                                                                                        <!-- Start. Compare List button-->
                                                                                        <?php if (!Yii::$app->compare->existInList($value->id)) { ?>
                                                                                            <div id="toCompare" class="btn-compare">
                                                                                                <button class="toCompare" type="button" data-title="В список сравнений"
                                                                                                        onclick="addToCompareList(<?php echo $value->id; ?>, $(this))" >
                                                                                                    <span class="icon_compare"></span>
                                                                                                    <span class="text-el d_l">В список сравнений</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div id="inCompare" class="btn-compare btn-comp-in d_n">
                                                                                                <a href="<?php echo Yii::$app->urlHelper->to(['compare/compare']); ?>"
                                                                                                   style="padding-top: 8px; padding-bottom: 9px;"><button class="toCompare" type="button" data-title="В список сравнений">
                                                                                                        <span class="icon_compare"></span>
                                                                                                        <span class="text-el d_l">В список сравнений</span>
                                                                                                    </button></a>
                                                                                            </div>
                                                                                        <?php } else { ?>
                                                                                            <div class="btn-compare btn-comp-in">
                                                                                                <a href="<?php echo Yii::$app->urlHelper->to(['compare/compare']); ?>"
                                                                                                   style="padding-top: 8px; padding-bottom: 9px;"><button class="toCompare" type="button" data-title="В список сравнений">
                                                                                                        <span class="icon_compare"></span>
                                                                                                        <span class="text-el d_l">В список сравнений</span>
                                                                                                    </button></a>
                                                                                            </div>
                                                                                        <?php } ?>
                                                                                        <!-- End. Compare List button -->
                                                                                    </div>
                                                                                    <!-- Start. Wish list buttons -->
                                                                                    <div class="frame-btn-wish js-variant-17906 js-variant d_i-b_">
                                                                                        <div class="btnWish btn-wish">
                                                                                            <?php if ($value->inWishList()) { ?>
                                                                                                <button id="inwish-<?php echo $value->id; ?>" class="inWishlist"
                                                                                                        data-title="В списке желаний">
                                                                                                    <a href="<?php echo Yii::$app->urlHelper->to(['profile']) ?>">
                                                                <span class="icon_wish"
                                                                      style="background-position: -160px 0;"></span>
                                                                                                        <span class="text-el d_l">В списке желания</span>
                                                                                                    </a>
                                                                                                </button>
                                                                                            <?php } else { ?>
                                                                                                <button id="towish-<?php echo $value->id; ?>" class="toWishlist"
                                                                                                        onclick="
                                                                                                            openWishWindow(<?php echo Yii::$app->user->isGuest ? 1 : 0; ?>, <?php echo $value->id; ?>);
                                                                                                            "><span class="icon_wish"></span>
                                                                                                    <span class="text-el d_l">В желаемое</span>
                                                                                                </button>
                                                                                                <button id="inwish-<?php echo $value->id; ?>"
                                                                                                        class="inWishlist d_n"
                                                                                                        data-title="В списке желаний">
                                                                                                    <a href="<?php echo Yii::$app->urlHelper->to(['profile']) ?>">
                                                                <span class="icon_wish"
                                                                      style="background-position: -160px 0;"></span>
                                                                                                        <span class="text-el d_l">В списке желания</span>
                                                                                                    </a>
                                                                                                </button>
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- End. wish list buttons -->
                                                                                </div>
                                                                                <!-- End. Wish List & Compare List buttons -->
                                                                            </div>
                                                                            <div class="decor-element"
                                                                                 style="height: 281px; width: 100%; position: absolute; right: auto; left: 0px; bottom: auto; top: 0px;">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    $("#owl-demo2").owlCarousel({

                                                        navigation : false,
                                                        slideSpeed : 500,
                                                        paginationSpeed : 500,
                                                        singleItem : true,
                                                        autoPlay: 5000,
                                                        stopOnHover: true,
                                                        baseClass: 'owl-carousel',
                                                        autoHeight: true

                                                    });
                                                });
                                            </script>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://active.imagecmsdemo.net/templates/active/js/cusel-min-2.5.js"></script>
</div>
<div class="h-footer"></div>
<div id="forCenter" class="forCenter d_n" data-rel="#wishListPopup"
     style="left: 0px; width: 100%; position: fixed; height: 100%; overflow-x: auto; z-index: 1105; display: block; top: 0px; background: rgba(0, 0, 0, 0.8);">
    <div class="drop drop-style drop-wishlist center active" id="wishListPopup"
         style="z-index: 1105; position: fixed; display: block; top: 20%; left: 491px;">
        <button type="button" class="icon_times_drop" data-closed="closed-js" onclick="closeWishWindow()"></button>
        <div class="drop-header">
            <div class="title">
                Выбор cписка желаний
            </div>
        </div>
        <div class="drop-content" style="overflow: hidden; padding: 0px; height: 197px; width: 300px;">
            <div class="jspContainer" style="width: 300px; height: 189px;">
                <div class="jspPane" style="padding: 0px; top: 0px; width: 300px;">
                    <div class="inside-padd">
                        <div class="horizontal-form">
                            <form method="post" action="" onsubmit="return false;">
                                <div class="frame-radio">
                                    <?php if (!empty($wishLists)) { ?>
                                        <div class="frame-label active">
                                            <input class="wishRadio" type="radio" name="wishlist" value="1"
                                                   checked="checked">
                                            <select id="wishSelect"
                                                    style="width:217px;border-color: #dfdfdf;padding-left:5px;box-shadow: inset 0 1px 1px #f8f7f7;">
                                                <?php foreach ($wishLists as $list) { ?>
                                                    <option
                                                        value="<?php echo $list->id; ?>"><?php echo $list->title; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <div class="frame-label">
                                        <input class="wishRadio" type="radio" name="wishlist" value="2"
                                               data-link="[name=&quot;wishListName&quot;]">
                                        Новый
                                    </div>
                                </div>
                                <div class="frame-label">
                                    <input type="text" name="wishListName" value="" class="wish_list_name">
                                </div>
                                <div class="btn-def">
                                    <button type="submit" onclick="addToWishList()" сlass="isDrop">
                                        <span class="text-el">Добавить в список</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="drop-footer"></div>
    </div>
</div>
<div id="forCenterAuth" class="forCenter d_n" data-rel="#wishListPopup"
     style="left: 0px; width: 100%; position: fixed; height: 100%; overflow-x: auto; z-index: 1105; display: block; top: 0px; background: rgba(0, 0, 0, 0.8);">
    <div class="drop drop-style center active" id="dropAuth"
         style="z-index: 1104; position: fixed; display: block; top: 40%; left: 491px;">
        <button type="button" class="icon_times_drop" data-closed="closed-js" onclick="closeWishAuthWindow()"></button>
        <div class="drop-content t-a_c"
             style="min-height: 0px; overflow: hidden; padding: 0px; height: 75px; width: 350px;">
            <div class="jspContainer" style="width: 350px; height: 75px;">
                <div class="jspPane" style="padding: 0px; top: 0px; width: 350px;">
                    <div class="inside-padd">
                        Для того, что бы добавить товар в список желаний, Вам нужно <a
                            href="<?php echo Yii::$app->urlHelper->to(['login']); ?>">
                            <button type="button" class="d_l_1 isDrop">авторизоваться</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>