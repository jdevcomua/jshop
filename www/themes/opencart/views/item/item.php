<?php

use yii\helpers\Html;

/* @var $form yii\widgets\ActiveForm */
?>

<div class="content">
    <br>
    <?php /* @var $item common\models\Item */ ?>
    <div class="frame-inside page-product">
        <div class="container">
            <div class="clearfix">
                <div class="f-s_0 title-product">
                    <!-- Start. Name product -->
                    <?php if (isset($message)) { ?>
                    <div style="width: 505px; background: #fbfff9; border:1px solid #96C61E; padding: 10px;border-radius: 2%;margin-bottom: 15px;">
                        <span style="opacity: 1;"><?php echo $message; ?></span>
                    </div>
                    <?php } ?>
                    <div class="frame-title">
                        <h1 class="title m-r_5"><?php echo $item['title']; ?></h1>
                    </div>
                </div>
                <div class="right-product">
                    <!--Start. Payments method form -->
                    <div class="frame-delivery-payment">
                        <dl>
                            <dt class="title"><?php echo \Yii::t('app', 'Доставка и оплата'); ?></dt>
                            <dd class="frame-list-delivery">
                                <ul class="list-delivery">
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p1">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el"><?php echo \Yii::t('app', 'Самовывоз'); ?></span><span class="d_b s-t"><?php echo \Yii::t('app', 'Со склада магазина'); ?></span>
                                        </div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p2">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el"><?php echo \Yii::t('app', 'Курьерской службой'); ?> </span><span
                                                class="d_b s-t"><?php echo \Yii::t('app', 'Новая почта и другие'); ?></span></div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p3">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el"><?php echo \Yii::t('app', 'Оплата наличными'); ?></span><span
                                                class="d_b s-t"><?php echo \Yii::t('app', 'Курьеру при получении'); ?></span></div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p4">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el"><?php echo \Yii::t('app', 'Безналичный платеж'); ?></span><span
                                                class="d_b s-t"><?php echo \Yii::t('app', 'Master Card, Visa; Приват 24'); ?></span></div>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                    <div class="frame-delivery-payment">
                        <dl>
                            <dt class="title"><?php echo \Yii::t('app', 'Нужна помощь?'); ?></dt>
                            <dd class="frame-list-delivery"><span class="s-t"><?php echo \Yii::t('app', 'Наши менеджеры ответят на ваши вопросы и помогут с выбором:'); ?></span>
                                <ul class="list-style-1 list-phone-number">
                                    <li class="f-s_15">(093) <span class="d_n">−</span>169-36-98</li>
                                    <li class="f-s_15">(093) <span class="d_n">−</span>169-36-98</li>
                                </ul>
                            </dd>
                        </dl>
                    </div>                    <!--End. Payments method form -->
                    <!-- Start. Similar Products-->
                    <div class="default-frame">
                        <section class="">
                            <div class="default-title">
                                <div class="frame-title">
                                    <div class="title"><?php echo \Yii::t('app', 'Похожие товары'); ?></div>
                                </div><?php echo \Yii::t('app', ''); ?>
                            </div>

                        </section>
                    </div>
                    <!-- End. Similar Products-->
                </div>
                <div class="left-product leftProduct">
                    <div class="clearfix item-product globalFrameProduct to-cart">
                        <div class="left-product-left">
                            <style>
                                #owl-demo .item img{
                                    display: block;
                                    max-height: 300px;
                                    max-width: 282px;
                                    height: auto;
                                }
                            </style>
                            <div id="demo">
                                <div class="container">
                                    <div class="row">
                                        <div  class="span12">
                                            <div id="owl-demo" class="owl-carousel">
                                                <?php foreach ($item->getImageUrls() as $url) { ?>
                                                    <div class="item" align="center">
                                                        <img  src="<?php echo $url; ?>">
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
                                        slideSpeed : 300,
                                        paginationSpeed : 400,
                                        singleItem : true

                                    });
                                });
                            </script>
                        </div>
                        <div class="left-product-right">
                            <!-- Start. Star rating -->
                            <?php if ($item->getAvgRating()['avg'] != 0) { ?>
                                <div class="mark-pr">
                                    <span class="title"><?php //echo \Yii::t('app', 'Оценка товара:'); ?></span>
                                    <div class="rateit" data-rateit-value="<?php echo $item->getAvgRating()['avg']; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                    (<?php echo $item->getAvgRating()['count']; ?>)
                                </div>
                            <?php } ?>
                            <!-- End. Star rating-->
                            <!-- Start. frame for cloudzoom -->
                            <div id="xBlock"></div>
                            <!-- End. frame for cloudzoom -->
                            <div class="f-s_0 buy-block">
                                <!-- Start. Check variant-->
                                <!-- End. Check variant-->
                                <div class="frame-prices-buy-wish-compare">
                                    <div class="frame-prices-buy f-s_0">
                                        <!-- Start. Prices-->
                                        <div class="frame-prices f-s_0">
                                            <!-- Start. Check old price-->
                                            <?php if ($item->existDiscount()) { ?>
                                                <span class="price-discount"><span>
                                                    <span class="price priceOrigVariant"><?php echo $item->cost; ?></span> грн.</span>
                                                </span>
                                            <?php } ?>
                                            <!-- End. Check old price-->
                                            <!-- Start. Product price-->
                                            <span class="current-prices f-s_0">
                                                <span class="price-new"><span>
                                                    <span class="price priceVariant"><?php echo $item->existDiscount() ? $item->getNewPrice() : $item->cost; ?></span> грн.</span>
                                                </span>
                                            </span>
                                            <!-- End. Product price-->
                                        </div>
                                        <!-- End. Prices-->
                                        <div class="funcs-buttons">
                                            <!-- Start. Collect information about Variants, for future processing -->
                                            <div class="d_i-b v-a_b">
                                                <div class="frame-count-buy js-variant-17917 js-variant">
                                                    <div style="display:block; float:left;margin-right:10px;">
                                                        <?php
                                                        echo Html::input('number', 'count', '1', ['id' => 'test', 'style' => 'height: 30px;padding: 0 0 0 5px;width:75px;']);
                                                        ?>
                                                    </div>
                                                    <div class="btn-buy-p btn-buy" style="display:block; float:left;">
                                                        <?php echo Html::button('<span class="text-el">' . \Yii::t('app', 'В корзину') . '</span>', ['onClick' => 'addToCartFromItemPage(' . $item->id . ')']); ?>
                                                    </div>
                                                </div>
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
                                                                onclick="addToCompareList(<?php echo $item->id; ?>)" >
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
                            <!-- Start. Description -->
                            <div class="short-desc">
                                <p></p>
                            </div>
                        </div>
                    </div>

                    <?php if ($item->hasKit()) {
                        ?>
                    <div class="container">
                        <section class="frame-complect horizontal-carousel">
                            <div class="frame-title">
                                <div class="title">Комплект по выгодной цене</div>
                            </div>
                            <div class="carousel-js-css items-carousel complects-carousel jcarousel-container jcarousel-container-horizontal iscarousel" style="position: relative; display: block;">
                                <div class="content-carousel">
                                    <div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
                                        <ul class="items-complect items jcarousel-list jcarousel-list-horizontal" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px; width: 1272px;">
                                            <?php foreach ($item->kits as $kit) {

                                                ?>
                                            <li class="globalFrameProduct to-cart jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" jcarouselindex="1" style="float: left; list-style: none; width: 596px;">
                                                <ul class="items items-bask row-kits rowKits">

                                                    <li clsss="f-s_0">
                                                        <div class="frame-kit main-product">
                                                            <div class="frame-photo-title">
                                            <span class="photo-block">
                                                <span class="helper"></span>
                                                <img src="<?php echo array_shift($item->getImageUrls()); ?>">
                                                                                          </span>
                                                                <span class="title"><?php echo $item->getTitle()?></span>
                                                            </div>
                                                            <div class="description">
                                                                <div class="frame-prices f-s_0">
                                                                    <!-- Start. Product price-->
                                                <span class="current-prices f-s_0">
                                                    <span class="price-new">
                                                        <span>
                                                            <span class="price priceVariant"><?php echo $item->getCost();?></span> грн.
                                                        </span>
                                                    </span>
                                                                                                    </span>
                                                                    <!-- End. Product price-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <?php foreach ($kit->kitItems as $kitItem) {
                                                        /* @var $kitItem \common\models\KitItem */
                                                        if($kitItem->item_id != $item->id) {
                                                        ?>
                                                    <li class="f-s_0">
                                                        <div class="next-kit">+</div>
                                                        <div class="frame-kit">
                                                            <a href="http://active.imagecmsdemo.net/shop/product/perchatki-velosipednye-cyclotech-racer" class="frame-photo-title">
                                            <span class="photo-block">
                                                <span class="helper"></span>
                                                <img src="<?php echo array_shift($kitItem->item->getImageUrls()); ?>">


                                                                                            </span>
                                                                <span class="title"><?php echo $kitItem->item->getTitle(); ?></span>
                                                            </a>
                                                            <div class="description">
                                                                <div class="frame-prices f-s_0">
                                                                    <!-- Check for discount-->
                                                                    <!-- Start. Product price-->

                                                                    <span class="current-prices f-s_0">
                                                                        <span class="price-new">
                                                                            <span>
                                                                                <span class="price priceVariant"><?php echo $kitItem->item->getCost(); ?></span> грн.
                                                                            </span>
                                                                        </span>
                                                                    </span>

                                                                    <!-- End. Product price-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php } } ?>
                                                </ul>
                                                <!-- total -->
                                                <div class="complect-gen-sum">
                                                    <div class="gen-sum-kit">=</div>
                                                    <div class="frame-gen-price-buy-complect">
                                                        <div class="frame-prices f-s_0">
                                        <span class="price-discount">
                                            <span>
<span class="price"><?php
    $sum = 0.0;
    foreach (\common\models\Kit::findOne(1)->kitItems as $kitItem) {
        /* @var $kitItem \common\models\KitItem */
        $sum = $kitItem->item->cost;
    }
    echo $sum;
    ?></span> грн.
                                            </span>
                                        </span>
                                        <span class="current-prices f-s_0">
                                            <span class="price-new">
                                                <span>
<span class="price"><?php echo $kit->cost; ?></span> грн.
                                                </span>
                                            </span>
                                                                                    </span>
                                                        </div>
                                                            <div class="btn-cart-p btn-cart d_n">
                                                                <button type="button" data-id="16" class="btnBuy infoBut btnBuyKit">
                                                                    <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                    <span class="text-el">В корзине</span>
                                                                </button>
                                                            </div>
                                                            <div class="btn-buy-p btn-buy">
                                                                <button type="button" data-id="16" onclick="addKit(<?php echo $kit->id?>)" class="btnBuy infoBut btnBuyKit">
                                                                    <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                    <span class="text-el">Купить</span>
                                                                </button>
                                                            </div>
                                                    </div>
                                                </div>
                                                <!-- /total -->
                                            </li>
                                            <?php } ?>
                                        </ul></div>
                                </div>
                                <!-- Start. Buttons for next/prev kit-->
                                <div class="group-button-carousel">


                                    <button type="button" class="prev arrow jcarousel-prev jcarousel-prev-horizontal jcarousel-prev-disabled jcarousel-prev-disabled-horizontal" disabled="disabled" style="display: inline-block;">
                                        <span class="icon_arrow_p"></span>
                                    </button><button type="button" class="next arrow jcarousel-next jcarousel-next-horizontal" style="display: inline-block;">
                                        <span class="icon_arrow_n"></span>
                                    </button></div>
                                <!-- Start. Buttons for next/prev kit-->
                            </div>
                        </section>
                    </div>
                    <?php } ?>
                    <!-- Start. Tabs block-->
                    <div class="f-s_0">
                        <div class="frame-tabs-ref frame-tabs-product">
                            <div id="view">
                                <?php if ($item->getCharacteristicItems()->count() > 0) { ?>
                                <div class="inside-padd">
                                    <div class="title-h2"><?php echo \Yii::t('app', 'Свойства'); ?></div>
                                    <div class="characteristic">
                                        <div class="product-charac patch-product-view showHidePart">
                                            <table border="0" cellpadding="4" cellspacing="0" class="characteristic">
                                                <tbody>
                                                <?php foreach ($item->characteristicItems as $value) {
                                                    /* @var $value common\models\CharacteristicItem */
                                                    if (!empty($value->value)) {
                                                        echo "<tr><td>" . $value->characteristic->title . "</td>";
                                                        echo "<td>" . $value->value . "</td></tr>";
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button class="t-d_n f-s_0 s-all-d ref2 d_n_"
                                                data-trigger="[data-href='#first']" data-scroll="true">
                                            <span class="icon_arrow"></span>
                                            <span class="text-el"><?php echo \Yii::t('app', 'Смотреть все'); ?></span>
                                        </button>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if (!empty($item->description)) { ?>
                                <div class="inside-padd" style="margin: 0;">
                                    <!--                        Start. Description block-->
                                    <div class="product-descr patch-product-view showHidePart">
                                        <div class="text">
                                            <div class="title-h2"><?php echo \Yii::t('app', 'Описание'); ?></div>
                                            <p><?php echo $item->description; ?></p>
                                            </div>
                                    </div>
                                    <!--                        End. Description block-->
                                </div>
                                <?php } ?>

                                <div class="inside-padd">
                                    <!--Start. Comments block-->
                                    <div class="frame-form-comment">
                                        <div class="forComments p_r">
                                            <div class="comments" id="comments">
                                                <?php if ($item->getVotes()->count() > 0) { ?>
                                                <div class="title-h2"><?php echo \Yii::t('app', 'Отзывы'); ?></div>
                                                <div class="drop comments-main-form  active inherit">
                                                    <div class="frame-comments layout-highlight horizontal-form">

                                                    </div>
                                                </div>
                                                <div class="frame-list-comments">
                                                    <ul class="sub-1 product-comment patch-product-view showHidePart">
                                                        <?php foreach ($item->votes as $vote) {
                                                            /* @var $vote \common\models\Vote */
                                                            if ($vote->checked == 1) {
                                                            ?>
                                                        <li><hr>
                                                            <div style="padding: 10px 0 5px 0;" class="clearfix global-frame-comment-sub1">
                                                                <div class="author-data-comment author-data-comment-sub1">
                                                                    <span class="f-s_0 frame-autor-comment"><span class="icon_comment"></span>
                                                                        <span class="author-comment"><b><?php echo isset($vote->user) ? $vote->user->name : 'Гость'; ?></b></span></span>
                                                                    <span class="date-comment">
                                                                        <span class="day"><?php echo $vote->timestamp; ?></span>
                                                                    </span>
                                                                    <?php if (!empty($vote->rating)) { ?>
                                                                    <div class="mark-pr">
                                                                        <span class="title"><?php echo \Yii::t('app', 'Оценка товара:'); ?></span>
                                                                        <div class="rateit" data-rateit-value="<?php echo $vote->rating; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>

                                                                    </div>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="frame-comment-sub1">
                                                                    <div class="frame-comment">
                                                                        <p><?php echo $vote->text; ?></p>
                                                                    </div>
                                                                    <div class="footer-comment clearfix">

                                                                        <!--<div class="frame-mark f_r">
                                                                            <div class="func-button-comment">
                                                                                <span class="s-t"><?php echo \Yii::t('app', 'Отзыв полезен?'); ?></span>
                                    <span class="btn like">
                                        <button type="button" class="usefullyes" data-comid="3">
                                            <span class="icon_like"></span>
                                            <span class="text-el d_l_3"><?php //echo \Yii::t('app', 'Да'); ?><span class="yesholder3 d_n">(0)</span></span>
                                        </button>
                                    </span>
                                    <span class="btn dis-like">
                                        <button type="button" class="usefullno" data-comid="3">
                                            <span class="icon_dislike"></span>
                                            <span class="text-el d_l_4"><?php //echo \Yii::t('app', 'Нет'); ?><span class="noholder3 d_n">(0)</span></span>
                                        </button>
                                    </span>
                                                                            </div>
                                                                        </div>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php } } ?>
                                                    </ul>
                                                </div>
                                                <?php } ?>
                                                <br>
                                                <div class="frame-drop-comment" data-rel="whoCloneAddPaste">
                                                    <div class="form-comment layout-highlight frame-comments">
                                                        <h4>Оставить отзыв</h4>
                                                        <div class="inside-padd horizontal-form">
                                                            <?php echo $this->render('vote', [
                                                                'vote' => new \common\models\Vote(), 'model' => $item
                                                            ]) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End. Comments block-->
                                    </div>
                                </div>
                            </div>
                            <!--             Start. Characteristic-->


                        </div>
                        <!-- End. Tabs block-->
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="http://active.imagecmsdemo.net/templates/active/js/cusel-min-2.5.js"></script>
</div>
<div class="h-footer"></div>