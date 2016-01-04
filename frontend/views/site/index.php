<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php echo $this->render('../layouts/menu', ['allCategories' => $allCategories]); ?>

<div class="content">
    <br>
    <div class="frame-inside page-category">
        <div class="container">
            <div class="right-catalog">
                <!-- Start. Category name and count products in category-->
                <div class="f-s_0 title-category">
                    <div class="frame-title">
                        <h1 class="title"><?php echo $categoryTitle; ?></h1>
                    </div>
                <span class="count"><?php

                    echo \Yii::t('app', 'Найдено {0} товаров', $count); ?></span>
                </div>
                <!-- End. Category name and count products in category-->
                <!--Start. Banners block-->

                <!--End. Banners-->
                <div class="frame-header-category">
                    <div class="header-category f-s_0">
                        <div class="inside-padd clearfix">
                            <!-- Start. Order by block -->
                            <div class="frame-sort f_l">
                                <span class="title s-t f_l"><?php echo \Yii::t('app', 'Сортировать'); ?></span>
                                <ul class="nav-sort nav f_l" id="sort" name="order">
                                    <li>
                                        <button type="button" data-value="action"
                                                class="d_l_3"><?php echo \Yii::t('app', 'Акции'); ?></button>
                                    </li>
                                    <li><a href="?category=<?php echo "$category_id"; ?>&sort=asc"
                                           class="d_l_3"><?php echo \Yii::t('app', 'От дешевых к дорогим'); ?></a></li>
                                    <li><a href="?category=<?php echo "$category_id"; ?>&sort=desc"
                                           class="d_l_3"><?php echo \Yii::t('app', 'От дорогих к дешевым'); ?></a></li>
                                    <li>
                                        <button type="button" data-value="hit"
                                                class="d_l_3"><?php echo \Yii::t('app', 'Популярные'); ?></button>
                                    </li>
                                    <li>
                                        <button type="button" data-value="rating"
                                                class="d_l_3"><?php echo \Yii::t('app', 'Рейтинг'); ?></button>
                                    </li>
                                    <li>
                                        <button type="button" data-value="hot"
                                                class="d_l_3"><?php echo \Yii::t('app', 'Новинки'); ?></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="animateListItems items items-catalog  table" id="items-catalog-main">

                    <?php
                    foreach ($items as $i => $value) { ?>

                        <li class="globalFrameProduct to-cart" data-pos="top">
                            <a href="<?php echo Yii::$app->urlHelper->to(['item', 'id' => $value->id]); ?>"
                               class="frame-photo-title">
                                <span class="photo-block"><span class="helper"></span><img
                                        src="<?php echo $value->getImageUrl(); ?>"></span>
                                <span class="title">"<?php echo $value['title']; ?></span></a>
                            <div class="description">
                                <div class="left-description">
                                    <div class="frame-star f-s_0">
                                        <div class="star">
                                            <div id="star_rating_17337" class="productRate star-small">
                                                <div style="width: 0%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="frame-prices-buttons">
                                    <div class="frame-prices f-s_0"><span class="current-prices f-s_0">
                                        <span class="price-new"><span><span
                                                    class="price priceVariant"><?php echo $value['cost']; ?></span> </span></span>
                                        </span></div>
                                    <div class="f-s_0 m-b_10">
                                        <div class="funcs-buttons">
                                            <!-- Start. Collect information about Variants, for future processing -->
                                            <div class="frame-count-buy js-variant-17906 js-variant">
                                                <?php if (Yii::$app->cart->checkItemInCart($value->id)) { ?>
                                                    <div id="inCart-<?php echo $value->id ?>" class="btn-buy btn-cart">
                                                        <a href="<?php echo Yii::$app->urlHelper->to(['cart'])?>" style="padding: 0 9px 0 7px;"><button type="button" class="btnBuy" style="padding-top: 8px;">
                                                            <span class="icon_cleaner icon_cleaner_buy"></span>
                                                            <span class="text-el">В корзине</span>
                                                        </button></a>
                                                    </div>
                                                <?php } else { ?>
                                                    <div id="inCart-<?php echo $value->id ?>"
                                                         class="btn-buy btn-cart d_n">
                                                        <a href="<?php echo Yii::$app->urlHelper->to(['cart'])?>" style="padding: 0 9px 0 7px;"><button type="button" class="btnBuy" style="padding-top: 8px;">
                                                            <span class="icon_cleaner icon_cleaner_buy"></span>
                                                            <span class="text-el">В корзине</span>
                                                        </button></a>
                                                    </div>
                                                    <div id="toCart-<?php echo $value->id ?>" class="btn-buy">
                                                        <button type="button" class="btnBuy infoBut" onclick="
                                                            $.ajax({
                                                            url: '/cart/ajax',
                                                            data: { count: 1, item_id: <?php echo $value->id ?> },
                                                            dataType: 'text',
                                                            success: function(data){
                                                            var count = +$('#countItems ').html();
                                                            if (count == 0) {
                                                            $('#cartEmpty').toggleClass('d_n');
                                                            $('#cartFull').toggleClass('d_n');
                                                            }
                                                            $('#countItems ').html(+count + 1);
                                                            $('#toCart-' + '<?php echo $value->id ?>').toggleClass('d_n');
                                                            $('#inCart-' + '<?php echo $value->id ?>').toggleClass('d_n');
                                                            }
                                                            });">
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
                                            <!-- Start. Wish list buttons -->
                                            <div class="frame-btn-wish js-variant-17906 js-variant d_i-b_">
                                                <div class="btnWish btn-wish" data-id="17906">
                                                    <button class="toWishlist isDrop" type="button" data-rel="tooltip"
                                                            data-title="В желаемое" data-drop="#dropAuth">
                                                        <span class="icon_wish"></span>
                                                        <span class="text-el d_l">В желаемое</span>
                                                    </button>
                                                    <button class="inWishlist" type="button" data-rel="tooltip"
                                                            data-title="В списке желаний" style="display: none;">
                                                        <span class="icon_wish"></span>
                                                        <span class="text-el d_l">В списке желания</span>
                                                    </button>
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
            <div class="filter left-catalog">

                <?php if ($category_id != '0') {

                    $form = ActiveForm::begin(); ?>
                    <div class="frame-filter p_r">
                        <div class="preloader wo-i" style="display: none;"></div>
                        <div id="slider-range"></div>
                        <div class="frames-checks-sliders">
                            <div class="frame-slider" data-rel="sliders.slider1">
                                <div class="inside-padd">
                                    <div class="title"><?php echo \Yii::t('app', 'Фильтр по цене'); ?></div>
                                    <br>
                                    <div id="slider"></div>
                                    <br>
                                    <?php
                                    echo '<script>';
                                    echo 'var maxCost = ' . $maxCost . ';';
                                    echo 'var minCost = ' . $minCost . ';';
                                    echo 'var leftCost = ' . $leftCost . ';';
                                    echo 'var rightCost = ' . $rightCost . ';';
                                    echo '</script>';
                                    ?>
                                    <style>
                                        .noUi-base {
                                            width: 100%;
                                            height: 100%;
                                            position: relative;
                                            z-index: 1
                                        }

                                        .noUi-origin {
                                            position: absolute;
                                            right: 0;
                                            top: 0;
                                            left: 0;
                                            bottom: 0
                                        }

                                        .noUi-handle {
                                            position: relative;
                                            z-index: 1
                                        }

                                        .noUi-state-drag * {
                                            cursor: inherit !important
                                        }

                                        .noUi-horizontal {
                                            height: 7px
                                        }

                                        .noUi-horizontal .noUi-handle {
                                            width: 8px;
                                            height: 14px;
                                            left: -8px;
                                            top: -4px
                                        }

                                        .noUi-vertical .noUi-handle {
                                            width: 28px;
                                            height: 34px;
                                            left: -6px;
                                            top: -17px
                                        }

                                        .noUi-background {
                                            background: #FAFAFA;
                                            box-shadow: inset 0 1px 1px #f0f0f0
                                        }

                                        .noUi-connect {
                                            background: #81b504;
                                            box-shadow: inset 0 0 3px rgba(129, 181, 4, 0.45);
                                            -webkit-transition: background 450ms;
                                            transition: background 450ms
                                        }

                                        .noUi-handle {
                                            border: 1px solid #D9D9D9;
                                            border-radius: 3px;
                                            background: #FFF;
                                            cursor: default;
                                            box-shadow: inset 0 0 1px #FFF, inset 0 1px 7px #EBEBEB, 0 3px 6px -3px #BBB
                                        }
                                    </style>
                                    <script src="http://refreshless.com/noUiSlider/distribute/nouislider.min.js">
                                    </script>
                                    <script>var slider = document.getElementById('slider');
                                        noUiSlider.create(slider, {
                                            start: [leftCost, rightCost],
                                            connect: true,
                                            range: {
                                                'min': minCost,
                                                'max': maxCost
                                            }
                                        });
                                    </script>
                                    <input name="left" type="number" min="minCost" max="maxCost" step="1"
                                           id="input-number-left"
                                           style="width:75px; border: 1px solid #dfdfdf;padding: 0 5px;height: 31px;margin-left: 25px;">
                                    <input name="right" type="number" min="minCost" max="maxCost" step="1"
                                           id="input-number-right"
                                           style="width:75px; border: 1px solid #dfdfdf;padding: 0 5px;height: 31px;margin-bottom: 15px;">
                                    <script>
                                        var inputNumberLeft = document.getElementById('input-number-left');
                                        var inputNumberRight = document.getElementById('input-number-right');

                                        slider.noUiSlider.on('update', function (values, handle) {

                                            var value = values[handle];

                                            if (handle) {
                                                inputNumberRight.value = Math.round(value);
                                            } else {
                                                inputNumberLeft.value = Math.round(value);
                                            }
                                        });

                                        inputNumberLeft.addEventListener('change', function () {
                                            slider.noUiSlider.set([this.value, null]);
                                        });

                                        inputNumberRight.addEventListener('change', function () {
                                            slider.noUiSlider.set([null, this.value]);
                                        });
                                    </script>
                                </div>
                            </div>

                            <?php $i = 0;
                            foreach ($chars as $char) {
                                if (!empty($char->getCharacteristicItems()->all())) {

                                    ?>

                                    <div class="frame-group-checks">
                                        <div class="inside-padd">
                                            <div style="cursor: pointer;" class="title" onclick="
                                            $(this).parent('div').find('.filters-content').toggleClass('d_n');
                                            ">
                                                <span class="f-s_0">
                                                    <span class="icon-arrow"></span>
                                                    <span class="d_b">
                                                        <span class="text-el"><?php echo $char->title; ?> <img width="10px" src="http://rentlytics.com/wp-content/themes/rentlytics/img/arrow-down.png"></span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="filters-content d_n">
                                                <ul>
                                                    <?php
                                                    foreach ($char->getCharacteristicItems()->all() as $itemm) { ?>
                                                        <li>
                                                            <div class="frame-label" id="brand_281">

                                                                <?php $chr = new common\models\CharacteristicItem();
                                                                echo $form->field($chr, '[' . $i . ']characteristic_id')->hiddenInput(['value' => $char->id])->label('');
                                                                if (isset($selected[$i]['value'])) {
                                                                    echo $form->field($chr, '[' . $i . ']value')->input('checkbox', ['value' => $itemm->value, 'checked ' => ''])->label($itemm->value);
                                                                } else {
                                                                    echo $form->field($chr, '[' . $i . ']value')->input('checkbox', ['value' => $itemm->value])->label($itemm->value);
                                                                }
                                                                ?>
                                                            </div>
                                                        </li>
                                                        <?php $i = $i + 1;
                                                    } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                <?php }
                            } ?>

                            <div class="filter-foot">
                                <div class="inside-padd t-a_c">
                                    <div class="btn-form">
                                        <?php echo Html::submitButton('<span class="text-el" style="color: #000;" c>' . \Yii::t("app", "Фильтровать") . '</span>'); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php ActiveForm::end();
                } ?>

                <script>
                </script>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://active.imagecmsdemo.net/templates/active/js/cusel-min-2.5.js"></script>
</div>
<div class="h-footer"></div>