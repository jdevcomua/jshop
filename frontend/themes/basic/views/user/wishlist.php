<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\User */

use Yii;
$this->title = 'Список желаний';
?>

<div class="content">
    <br>
    <div class="frame-inside page-product">
        <div class="container">
            <div>
                        <div class="description">
                            <h2 data-wishlist-name="user_name" class="title">umo4ka</h2>
                            <!--<div class="date f-s_0">
                                <span class="day">01&nbsp;</span>
                                <span class="month">Января&nbsp;</span>
                                <span class="year">1970 </span>
                            </div>-->
                            <div class="text">
                                <p data-wishlist-name="description"></p>
                            </div>
                        </div>
            </div>
            <div id="list-<?php echo $list->id ?>" class="drop-style-2 drop-wishlist-items" data-rel="list-item">
                <div class="drop-header2">
                    <h2><?php echo $list->title; ?></h2>
                </div>
                <div class="drop-content2">
                    <div class="inside-padd">
                        <ul class="items items-catalog items-wish-list">
                            <?php foreach ($list->getWishes()->all() as $wish) {
                                /* @var $wish \common\models\Wish*/
                                $item = $wish->item;
                                ?>
                                <li id="wish-<?php echo $wish->id; ?>" class="globalFrameProduct to-cart" data-pos="top">
                                    <!-- Start. Photo & Name product -->
                                    <a href="<?php echo Yii::$app->urlHelper->to(['item','id'=>$item->id]);?>"
                                       class="frame-photo-title">
                                                                <span class="photo-block">
                                                                    <span class="helper"></span>
                                                                    <img src="<?php echo $item->getImageUrl(); ?>"></span>
                                        <span class="title"><?php echo $item->title; ?></span>
                                    </a>
                                    <!-- End. Photo & Name product -->
                                    <div class="description">
                                        <div class="left-description">
                                            <div class="frame-star f-s_0">
                                                <div class="star">
                                                    <div id="star_rating_17214"
                                                         class="productRate star-small">
                                                        <div style="width: 100%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End. Collect information about Variants, for future processing -->
                                        </div>
                                        <div class="frame-prices-buttons">
                                            <!-- Start. Prices-->
                                            <div class="frame-prices f-s_0">
                                                <!-- Start. Product price-->
                                                <span class="current-prices f-s_0">
                                                    <span class="price-new">
                                                        <span class="price priceVariant"><?php echo $item->cost; ?></span>
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
                                                        <!-- Start. Compare List button -->
                                                        <div class="btn-compare">
                                                            <button class="toCompare" data-id="17205" type="button"
                                                                    data-firtitle="В список сравнений"
                                                                    data-sectitle="В списке сравнений"
                                                                    data-title="В список сравнений" data-rel="tooltip">
                                                                <span class="icon_compare"></span>
                                                                <span class="text-el d_l">В список сравнений</span>
                                                            </button>
                                                        </div>
                                                        <!-- End. Compare List button -->
                                                    </div>
                                                </div>
                                                <!-- End. Wish List & Compare List buttons -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="decor-element"></div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="h-footer"></div>