<?php

use common\models\Item;

/* @var $category \common\models\ItemCat */
/* @var $value \common\models\Item */

$isWish = isset($wishListPage) && $wishListPage == true && isset($wishId);
?>
<?php if ($isWish) { ?>
    <div id="wish-<?= $wishId; ?>">
<?php } ?>
<a href="<?= $value->getUrl(); ?>" class="frame-photo-title">
    <span class="photo-block">
        <span class="helper"></span>
        <img src="<?= array_shift($value->getImageUrl(\common\models\Item::IMAGE_SMALL)); ?>">
        <?php if ($value->existDiscount()) { ?>
            <span class="product-status action"></span>
        <?php } ?>
    </span>
    <span class="title"><?php echo $value->title; ?></span>
</a>
<div class="description">
    <!-- Start. Star rating -->
    <?php if ($value->getAvgRating()['avg'] != 0) { ?>
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
                <span class="price-discount">
                    <span>
                        <span class="price priceOrigVariant" style="display: inline;">
                            <?php echo $value->cost; ?>
                        </span> грн.
                    </span>
                </span>
            <?php } ?>
            <!-- End. Check old price-->
            <!-- Start. Product price-->
            <span class="current-prices f-s_0">
                <span class="price-new">
                    <span>
                        <span class="price priceVariant">
                            <?= $value->existDiscount() ? $value->getNewPrice() : $value->cost; ?>
                        </span> грн.
                    </span>
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
                            <a href="<?php echo Yii::$app->urlHelper->to(['cart/index']) ?>" style="padding: 0 9px 0 7px;">
                                <button type="button" class="btnBuy" title="В корзине" style="padding-top: 8px;">
                                    <span class="icon_cleaner icon_cleaner_buy"></span>
                                </button>
                            </a>
                        </div>
                    <?php } else { ?>
                        <div id="inCart-<?php echo $value->id ?>" class="btn-buy btn-cart d_n">
                            <a href="<?php echo Yii::$app->urlHelper->to(['cart/index']) ?>" style="padding: 0 9px 0 7px;">
                                <button type="button" class="btnBuy" title="В корзине" style="padding-top: 8px;">
                                    <span class="icon_cleaner icon_cleaner_buy"></span>
                                </button>
                            </a>
                        </div>
                        <div id="toCart-<?php echo $value->id ?>" class="btn-buy">
                            <button type="button" class="btnBuy infoBut" title="Купить"
                                    onclick="addToCart(<?php echo $value->id ?>)">
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
                            <button class="toCompare" type="button" title="В список сравнений"
                                    onclick="addToCompareList(<?php echo $value->id; ?>, $(this))">
                                <span class="icon_compare"></span>
                            </button>
                        </div>
                        <div id="inCompare" class="btn-compare btn-comp-in d_n">
                            <a href="<?php echo Yii::$app->urlHelper->to(['compare/compare']); ?>"
                               style="padding-top: 8px; padding-bottom: 9px;">
                                <button class="toCompare" type="button" title="Сравнить товары">
                                    <span class="icon_compare"></span>
                                </button>
                            </a>
                        </div>
                    <?php } else { ?>
                        <div class="btn-compare btn-comp-in">
                            <a href="<?php echo Yii::$app->urlHelper->to(['compare/compare']); ?>"
                               style="padding-top: 8px; padding-bottom: 9px;">
                                <button class="toCompare" type="button" title="В список сравнений">
                                    <span class="icon_compare"></span>
                                </button>
                            </a>
                        </div>
                    <?php } ?>
                    <!-- End. Compare List button -->
                </div>
                <?php if (!$isWish) { ?>
                    <!-- Start. Wish list buttons -->
                    <div class="frame-btn-wish js-variant-17906 js-variant d_i-b_">
                        <div class="btnWish btn-wish">
                            <?php if ($value->inWishList()) { ?>
                                <button id="inwish-<?php echo $value->id; ?>" class="inWishlist" title="В списке желаний">
                                    <a href="<?php echo Yii::$app->urlHelper->to(['user/profile#wish_list']) ?>">
                                        <span class="icon_wish" style="background-position: -160px 0;"></span>
                                    </a>
                                </button>
                            <?php } else { ?>
                                <button id="towish-<?php echo $value->id; ?>" class="toWishlist" title="В список желаний"
                                        onclick="openWishWindow(<?php echo $value->id; ?>);">
                                    <span class="icon_wish"></span>
                                </button>
                                <button id="inwish-<?php echo $value->id; ?>" class="inWishlist d_n"
                                        title="В списке желаний">
                                    <a href="<?php echo Yii::$app->urlHelper->to(['user/profile#wish_list']) ?>">
                                        <span class="icon_wish"  style="background-position: -160px 0;"></span>
                                    </a>
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- End. wish list buttons -->
                <?php } ?>
            </div>
            <!-- End. Wish List & Compare List buttons -->
        </div>
        <div class="decor-element"
             style="height: 281px; width: 100%; position: absolute; right: auto; left: 0px; bottom: auto; top: 0px;">
        </div>
    </div>
</div>
<?php if ($isWish) { ?>
    <!-- Start. For wishlist page-->
    <div class="funcs-buttons-WL-item">
        <div class="btn-remove-item-wl">
            <button type="button" id="remove-<?= $wishId; ?>" class="btnRemoveItem isDrop"
                    onclick="removeItemFromWishList(<?= $wishId; ?>)">
                <span class="icon_remove"></span>
                <span class="text-el d_l_1">Удалить</span>
            </button>
        </div>
    </div>
    <!-- End. For wishlist page-->
    </div>
<?php } ?>