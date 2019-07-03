<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\User */

use Yii;
use common\models\ItemCat;
use common\models\Characteristic;

$this->registerJs("$('.items-compare').css('width', $('.compare_product').size()*$('.compare_product').first().width());");

$this->title = 'Сравнение товаров';
?>
<script>
    $(document).ready(function () {
        $('.tabs-compare-category').children(":first").toggleClass('active');
        var id = $('.categoryLink').filter('.active').attr('id').split('-')[1];
        $('#tab-' + id).toggleClass('active');
        $('#tab-' + id).attr('style', 'display: block;');
    });
</script>

<!--Start. Show compare list if count products >0 -->
<div class="no-empty js-no-empty">
    <!-- Start. Buttons for change to show different or all properties -->
    <div class="f-s_0 title-compare without-crumbs clearfix">
        <div class="frame-title">
            <h1 class="title">Сравнение товаров</h1>
        </div>
        <ul class="tabs groups-buttons tabs-compare-diferent">
            <li class="btn-def active btn-def-all">
                <button type="button" data-href="#all-params">
                    <span class="text-el">Все параметры</span>
                </button>
            </li>
            <li class="btn-def btn-def-only">
                <button type="button" data-href="#only-dif">
                    <span class="text-el">Только Различия</span>
                </button>
            </li>
        </ul>
    </div>
    <!-- End. Buttons for change to show different or all properties -->
    <?php if (Yii::$app->compare->isEmpty()) { ?>
        <div style="height: 15%;">Список сравнений пуст</div>
    <?php } else { ?>
        <div class="p_r">
            <!--Start. Show categories of products which are in list -->
            <!--End. Show categories of products which are in list -->
            <div class="frame-tabs-ref frame-tabs-compare">
                <?php foreach (Yii::$app->compare->getItems() as $category_id => $items) {
                    $category = ItemCat::findOne($category_id);
                    $characteristics = $category->getCharacteristics()->indexBy('id')->all();
                    ?>
                    <div id="tab-<?php echo $category_id; ?>" class="items-carousel">
                        <div class="left-compare">
                            <ul>
                                <li data-equalhorizcell="" style="height: 273px;"></li>
                            </ul>
                            <!--Start.Product properties names -->
                            <ul class="compare-characteristic characteristic-names">
                                <?php $count = 1;
                                foreach ($characteristics as $characteristic) {
                                    /* @var $characteristic Characteristic */
                                    ?>
                                    <li class="<?php echo ($count % 2 == 0) ? 'evenC' : 'oddC' ?>"
                                        style="height: 34px;">
                                        <span class="helper helper-comp" style="height: 34px;"></span>
                                        <span><?php echo $characteristic->title; ?></span>
                                    </li>
                                    <?php $count++;
                                } ?>
                            </ul>
                            <!--End. Product properties names -->
                        </div>
                        <div class="right-compare horizontal-carousel">
                            <div class="">
                                <div class="content-carousel" style="overflow-x: scroll;">
                                    <ul class="items items-compare" id="items-catalog-main">
                                        <!--Start. Show product block with characteristic by category-->
                                        <?php foreach ($items as $item) {
                                            /* @var $item \common\models\Item */
                                            ?>
                                            <li class="compare_product">
                                                <!--Start. Include product template-->
                                                <ul class="items items-catalog" style="height: 273px;">
                                                    <li class="globalFrameProduct to-cart" data-pos="top">
                                                        <a href="<?php echo Yii::$app->urlHelper->to(['item/item', 'id' => $item->id]); ?>"
                                                           class="frame-photo-title">
                                                            <span class="photo-block">
                                                                <span class="helper"></span>
                                                                <img src="<?= array_shift($item->getImageUrls()); ?>">
                                                            </span>
                                                            <span class="title"><?php echo $item->title; ?></span>
                                                        </a>
                                                        <div class="description">
                                                            <!-- Start. Star rating -->
                                                            <?php if ($item->getAvgRating()['avg'] != 0) { ?>
                                                                <div class="mark-pr">
                                                                    <span
                                                                        class="title"><?php //echo \Yii::t('app', 'Оценка товара:'); ?></span>
                                                                    <div class="rateit"
                                                                         data-rateit-value="<?php echo $item->getAvgRating()['avg']; ?>"
                                                                         data-rateit-ispreset="true"
                                                                         data-rateit-readonly="true"></div>
                                                                    (<?php echo $item->getAvgRating()['count']; ?>)
                                                                </div>
                                                            <?php } ?>
                                                            <!-- End. Star rating-->
                                                            <div class="frame-prices-buttons">
                                                                <div class="frame-prices f-s_0">
                                                                    <!-- Start. Check old price-->
                                                                    <?php if ($item->existDiscount()) { ?>
                                                                        <span class="price-discount">
                                                                            <span class="price priceOrigVariant">
                                                                                <?php echo $item->cost; ?>
                                                                            </span>
                                                                        </span>
                                                                    <?php } ?>
                                                                    <!-- End. Check old price-->
                                                                    <!-- Start. Product price-->
                                                                    <span class="current-prices f-s_0">
                                                                        <span class="price-new">
                                                                            <span class="price priceVariant">
                                                                                <?php echo $item->existDiscount() ? $item->getNewPrice() : $item->cost; ?>
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                    <!-- End. Product price-->
                                                                </div>
                                                                <div class="f-s_0 m-b_10">
                                                                    <div class="funcs-buttons">
                                                                        <!-- Start. Collect information about Variants, for future processing -->
                                                                        <div
                                                                            class="frame-count-buy js-variant-17906 js-variant">
                                                                            <?php if (Yii::$app->cart->checkItemInCart($item->id)) { ?>
                                                                                <div id="inCart-<?php echo $item->id ?>"
                                                                                     class="btn-buy btn-cart">
                                                                                    <a href="<?php echo Yii::$app->urlHelper->to(['cart/index']) ?>"
                                                                                       style="padding: 0 9px 0 7px;">
                                                                                        <button type="button"
                                                                                                class="btnBuy"
                                                                                                style="padding-top: 8px;">
                                                                                            <span
                                                                                                class="icon_cleaner icon_cleaner_buy"></span>
                                                                                            <span class="text-el">В корзине</span>
                                                                                        </button>
                                                                                    </a>
                                                                                </div>
                                                                            <?php } else { ?>
                                                                                <div id="inCart-<?php echo $item->id ?>"
                                                                                     class="btn-buy btn-cart d_n">
                                                                                    <a href="<?php echo Yii::$app->urlHelper->to(['cart/index']) ?>"
                                                                                       style="padding: 0 9px 0 7px;">
                                                                                        <button type="button"
                                                                                                class="btnBuy"
                                                                                                style="padding-top: 8px;">
                                                                                            <span
                                                                                                class="icon_cleaner icon_cleaner_buy"></span>
                                                                                            <span class="text-el">В корзине</span>
                                                                                        </button>
                                                                                    </a>
                                                                                </div>
                                                                                <div id="toCart-<?php echo $item->id ?>"
                                                                                     class="btn-buy">
                                                                                    <button type="button"
                                                                                            class="btnBuy infoBut"
                                                                                            onclick="addToCart(<?php echo $item->id ?>)">
                                                                                        <span
                                                                                            class="icon_cleaner icon_cleaner_buy"></span>
                                                                                        <span
                                                                                            class="text-el">Купить</span>
                                                                                    </button>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </div>

                                                                    </div>
                                                                    <!-- End. Collect information about Variants, for future processing -->
                                                                    <!-- Wish List & Compare List buttons -->
                                                                    <div class="frame-wish-compare-list f-s_0">
                                                                        <!-- Start. Wish list buttons -->
                                                                        <div
                                                                            class="frame-btn-wish js-variant-17906 js-variant d_i-b_">
                                                                            <div class="btnWish btn-wish">
                                                                                <?php if ($item->inWishList()) { ?>
                                                                                    <button
                                                                                        id="inwish-<?php echo $item->id; ?>"
                                                                                        class="inWishlist"
                                                                                        data-title="В списке желаний">
                                                                                        <a href="<?php echo Yii::$app->urlHelper->to(['user/profile#wish_list']) ?>">
                                                                                            <span class="icon_wish"
                                                                                                style="background-position: -160px 0;"></span>
                                                                                            <span class="text-el d_l">В списке желания</span>
                                                                                        </a>
                                                                                    </button>
                                                                                <?php } else { ?>
                                                                                    <button
                                                                                        id="towish-<?php echo $item->id; ?>"
                                                                                        class="toWishlist"
                                                                                        onclick="
                                                                                            openWishWindow(<?php echo $item->id; ?>);
                                                                                            "><span
                                                                                            class="icon_wish"></span>
                                                                                        <span class="text-el d_l">В желаемое</span>
                                                                                    </button>
                                                                                    <button
                                                                                        id="inwish-<?php echo $item->id; ?>"
                                                                                        class="inWishlist d_n"
                                                                                        data-title="В списке желаний">
                                                                                        <a href="<?php echo Yii::$app->urlHelper->to(['user/profile#wish_list']) ?>">
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
                                                                <button type="button"
                                                                        class="icon_times deleteFromCompare"
                                                                        onclick="deleteFromCompareList(<?php echo $item->id ?>, $(this))"></button>
                                                                <div class="decor-element"
                                                                     style="height: 273px; width: 100%; position: absolute; right: auto; left: 0px; bottom: auto; top: 0px;">
                                                                </div>
                                                    </li>
                                                </ul>
                                                <!-- End. Include product template-->
                                                <!--Start. Product characteristics -->
                                                <ul class="compare-characteristic">
                                                    <?php $charItems = $item->getCharacteristicItems()->indexBy('characteristic_id')->all();
                                                    $count = 1;
                                                    foreach ($characteristics as $characteristic) {
                                                        //var_dump($charItems[$characteristic->id]);die;
                                                        /* @var $charItem \common\models\CharacteristicItem */
                                                        ?>
                                                        <li class="<?php echo ($count % 2 == 0) ? 'evenC' : 'oddC' ?>"
                                                            style="height: 34px;">
                                                            <span class="helper helper-comp"
                                                                  style="height: 34px;"></span>
                                                            <span class="characteristic-value">
                                                                <?= array_key_exists($characteristic->id, $charItems) ? $charItems[$characteristic->id]->value : ''; ?>
                                                            </span>
                                                        </li>
                                                        <?php $count++;
                                                    } ?>
                                                </ul>
                                                <!--End. Product characteristics -->
                                            </li>
                                        <?php } ?>
                                        <!--End. Show product block with characteristic by category-->
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
                        <div class="scrollNSP jScrollPane"
                             style="overflow: hidden; width: 750px; top: 273px; padding: 0px;">
                            <div class="jspContainer" style="width: 750px; height: 16px;">
                                <div class="jspPane" style="padding: 0px; top: 0px; width: 750px;">
                                    <div style="width:500px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="comprasion-head" style="height: 273px;">
                <div class="title-h3">Категория:</div>
                <ul class="tabs tabs-compare-category">
                    <?php foreach (Yii::$app->compare->getCategories() as $category) {
                        /* @var $category \common\models\ItemCat */
                        ?>
                        <li id="link-<?php echo $category->id; ?>" class="categoryLink">
                            <button data-href="#tab_sportivnaia-obuv" onclick="changeCategoryInCompare($(this))">
                                <span class="text-el"><?php echo $category->title; ?></span>
                            </button>
                        </li>

                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>
</div>
<div class="js-empty empty">
    <div class="f-s_0 title-compare without-crumbs clearfix">
        <div class="frame-title">
            <h1 class="title">Сравнение товаров</h1>
        </div>
    </div>
    <div class="msg layout-highlight layout-highlight-msg">
        <div class="info">
            <span class="icon_info"></span>
            <span class="text-el">Вы удалили все товары из сравнения</span>
        </div>
    </div>
</div>
<!--End. Show compare list if count products >0 -->
