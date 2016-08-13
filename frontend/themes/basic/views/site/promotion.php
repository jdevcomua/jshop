<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model \common\models\Stock */
$this->title = $model->title;
?>

<?php if ($model->getItems()->count() > 0) { ?>
    <div class="">
        <!-- Start. Category name and count products in category-->
        <div class="f-s_0 title-category">
            <div class="frame-title">
                <h1 class="title"><?php echo $model->title; ?></h1>
            </div>
            <span class="count">До: <?php echo $model->date_to; ?></span>
        </div>
        <br>
        <!-- End. Category name and count products in category-->

        <ul class="animateListItems items items-catalog  table" id="items-catalog-main">

            <?php
            foreach ($model->items as $value) {
                /* @var $value \common\models\Item */
                ?>
                <li class="globalFrameProduct to-cart" style="width: 20% !important;">
                    <a href="<?= $value->getUrl(); ?>"
                       class="frame-photo-title">
                                <span class="photo-block"><span class="helper"></span><img
                                        src="<?php echo array_shift($value->getImageUrl()); ?>">
                                    <?php if ($value->existDiscount()) { ?>
                                        <span class="product-status action"></span>
                                    <?php } ?>
                                </span>
                        <span class="title"><?php echo $value['title']; ?></span></a>
                    <div class="description">
                        <!-- Start. Star rating -->
                        <?php if ($value->getAvgRating()['avg'] != 0) { ?>
                            <script src="/rateit/jquery.rateit.js" type="text/javascript"></script>
                            <div class="mark-pr">
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
                                    <span class="price-discount"><span
                                                    <span class="price priceOrigVariant"
                                                          style="display: inline;"><?php echo $value->cost; ?></span> грн.</span>
                                    </span>
                                <?php } ?>
                                <!-- End. Check old price-->
                                <!-- Start. Product price-->
                                            <span class="current-prices f-s_0">
                                                <span class="price-new"><span>
                                                    <span
                                                        class="price priceVariant"><?php echo $value->existDiscount() ? $value->getNewPrice() : $value->cost; ?> </span> грн. </span>
                                                </span>
                                            </span>
                                <!-- End. Product price-->
                            </div>
                            <div class="f-s_0 m-b_10">
                                <div class="funcs-buttons">
                                    <!-- Start. Collect information about Variants, for future processing -->
                                    <div class="frame-count-buy js-variant-17906 js-variant">
                                        <?php if (Yii::$app->cart->checkItemInCart($value->id)) { ?>
                                            <div id="inCart-<?php echo $value->id ?>" class="btn-buy btn-cart">
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
                                            <div id="inCart-<?php echo $value->id ?>"
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
                                            <div id="toCart-<?php echo $value->id ?>" class="btn-buy">
                                                <button type="button" class="btnBuy infoBut"
                                                        onclick="addToCart(<?php echo $value->id ?>)">
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
                                        <?php if (!Yii::$app->compare->existInList($value->id)) { ?>
                                            <div id="toCompare" class="btn-compare">
                                                <button class="toCompare" type="button" data-title="В список сравнений"
                                                        onclick="addToCompareList(<?php echo $value->id; ?>, $(this))">
                                                    <span class="icon_compare"></span>
                                                    <span class="text-el d_l">В список сравнений</span>
                                                </button>
                                            </div>
                                            <div id="inCompare" class="btn-compare btn-comp-in d_n">
                                                <a href="<?php echo Yii::$app->urlHelper->to(['compare/compare']); ?>"
                                                   style="padding-top: 8px; padding-bottom: 9px;">
                                                    <button class="toCompare" type="button"
                                                            data-title="В список сравнений">
                                                        <span class="icon_compare"></span>
                                                        <span class="text-el d_l">В список сравнений</span>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php } else { ?>
                                            <div class="btn-compare btn-comp-in">
                                                <a href="<?php echo Yii::$app->urlHelper->to(['compare/compare']); ?>"
                                                   style="padding-top: 8px; padding-bottom: 9px;">
                                                    <button class="toCompare" type="button"
                                                            data-title="В список сравнений">
                                                        <span class="icon_compare"></span>
                                                        <span class="text-el d_l">В список сравнений</span>
                                                    </button>
                                                </a>
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
                </li>

                <?php
            }
            ?>
        </ul>
    </div>
<?php } ?>
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