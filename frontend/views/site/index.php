<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php echo $this->render('menu', ['allCategories' => $allCategories]); ?>

<div class="content">
    <br>
    <div class="frame-inside page-category">
        <div class="container">
            <div class="right-catalog">
                <!-- Start. Category name and count products in category-->
                <div class="f-s_0 title-category">
                    <div class="frame-title">
                        <h1 class="title"><?php echo $categoryTitle;?></h1>
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
                                <span class="title s-t f_l"><?php echo \Yii::t('app', 'Сортировать');?></span>
                                <ul class="nav-sort nav f_l" id="sort" name="order">
                                    <li><button type="button" data-value="action" class="d_l_3"><?php echo \Yii::t('app', 'Акции');?></button></li>
                                    <li><a href="?category=<?php echo "$category_id"; ?>&sort=asc" class="d_l_3"><?php echo \Yii::t('app', 'От дешевых к дорогим');?></a></li>
                                    <li><a href="?category=<?php echo "$category_id"; ?>&sort=desc" class="d_l_3"><?php echo \Yii::t('app', 'От дорогих к дешевым');?></a></li>
                                    <li><button type="button" data-value="hit" class="d_l_3"><?php echo \Yii::t('app', 'Популярные');?></button></li>
                                    <li><button type="button" data-value="rating" class="d_l_3"><?php echo \Yii::t('app', 'Рейтинг');?></button></li>
                                    <li><button type="button" data-value="hot" class="d_l_3"><?php echo \Yii::t('app', 'Новинки');?></button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="animateListItems items items-catalog  table" id="items-catalog-main">

                    <?php
                    foreach ($items as $i => $value) {
                        echo "<li class=\"globalFrameProduct to-cart\" data-pos=\"top\"><a href=\"?id=";
                        echo $value['id'];
                        echo "\" class=\"frame-photo-title\"><span class=\"photo-block\"><span class=\"helper\"></span><img src=\"" . $value->getImageUrl() . "\" alt=\"\"></span><span class=\"title\">";
                        echo $value['title'];
                        echo "</span></a><div class=\"description\"><div class=\"left-description\"><div class=\"frame-star f-s_0\"><div class=\"star\"><div id=\"star_rating_17337\" class=\"productRate star-small\"><div style=\"width: 0%\"></div></div></div></div></div><div class=\"frame-prices-buttons\"><div class=\"frame-prices f-s_0\"><span class=\"current-prices f-s_0\"><span class=\"price-new\"><span><span class=\"price priceVariant\">";
                        echo $value['cost'];
                        echo "</span> </span></span></span></div>";
                        echo " <div class=\"decor-element\" style=\"height: 281px; width: 100%; position: absolute; right: auto; left: 0px; bottom: auto; top: 0px;\"></div>
    </li>";
                    }
                    ?>
                </ul>
            </div>
            <div class="filter left-catalog">

                <?php if ($category_id != '0') {

                    $form = ActiveForm::begin();?>
                    <div class="frame-filter p_r">
                        <div class="preloader wo-i" style="display: none;"></div>
                        <div id="slider-range"></div>
                        <div class="frames-checks-sliders">
                            <div class="frame-slider" data-rel="sliders.slider1">
                                <div class="inside-padd">
                                    <div class="title">Фильтр по цене</div>
                                    <br><div id="slider"></div><br>
                                    <?php
                                    echo '<script>';
                                    echo 'var maxCost = ' . $maxCost . ';';
                                    echo 'var minCost = ' . $minCost . ';';
                                    echo 'var leftCost = ' . $leftCost . ';';
                                    echo 'var rightCost = ' . $rightCost . ';';
                                    echo '</script>';
                                    ?>
                                    <style>.noUi-target,.noUi-target *{-webkit-touch-callout:none;-webkit-user-select:none;-ms-touch-action:none;touch-action:none;-ms-user-select:none;-moz-user-select:none;-moz-box-sizing:border-box;box-sizing:border-box}.noUi-target{position:relative;direction:ltr}.noUi-base{width:100%;height:100%;position:relative;z-index:1}.noUi-origin{position:absolute;right:0;top:0;left:0;bottom:0}.noUi-handle{position:relative;z-index:1}.noUi-stacking .noUi-handle{z-index:10}.noUi-state-tap .noUi-origin{-webkit-transition:left .3s,top .3s;transition:left .3s,top .3s}.noUi-state-drag *{cursor:inherit!important}.noUi-base{-webkit-transform:translate3d(0,0,0);transform:translate3d(0,0,0)}.noUi-horizontal{height:9px}.noUi-horizontal .noUi-handle{width:17px;height:14px;left:-8px;top:-3px}.noUi-vertical{width:18px}.noUi-vertical .noUi-handle{width:28px;height:34px;left:-6px;top:-17px}.noUi-background{background:#FAFAFA;box-shadow:inset 0 1px 1px #f0f0f0}.noUi-connect{background: #81b504;box-shadow:inset 0 0 3px rgba(129, 181, 4, 0.45);-webkit-transition:background 450ms;transition:background 450ms}  .noUi-origin{border-radius:2px}  .noUi-target{border-radius:4px;border:1px solid #81b504;box-shadow:inset 0 1px 1px #F0F0F0,0 3px 6px -5px #BBB}  .noUi-target.noUi-connect{box-shadow:inset 0 0 3px rgba(51,51,51,.45),0 3px 6px -5px #BBB}  .noUi-draggable{cursor:w-resize}  .noUi-vertical .noUi-draggable{cursor:n-resize}  .noUi-handle{border:1px solid #D9D9D9;border-radius:3px;background:#FFF;cursor:default;box-shadow:inset 0 0 1px #FFF,inset 0 1px 7px #EBEBEB,0 3px 6px -3px #BBB}  .noUi-active{box-shadow:inset 0 0 1px #FFF,inset 0 1px 7px #DDD,0 3px 6px -3px #BBB}  </style>
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
                                    <input name="left" type="number" min="minCost" max="maxCost" step="1" id="input-number-left" style="width:75px; border: 1px solid #dfdfdf;padding: 0 5px;height: 31px;margin-left: 25px;">
                                    <input name="right" type="number" min="minCost" max="maxCost" step="1" id="input-number-right" style="width:75px; border: 1px solid #dfdfdf;padding: 0 5px;height: 31px;margin-bottom: 15px;">
                                    <script>
                                        var inputNumberLeft = document.getElementById('input-number-left');
                                        var inputNumberRight = document.getElementById('input-number-right');

                                        slider.noUiSlider.on('update', function( values, handle ) {

                                            var value = values[handle];

                                            if ( handle ) {
                                                inputNumberRight.value = Math.round(value);
                                            } else {
                                                inputNumberLeft.value = Math.round(value);
                                            }
                                        });

                                        inputNumberLeft.addEventListener('change', function(){
                                            slider.noUiSlider.set([this.value, null]);
                                        });

                                        inputNumberRight.addEventListener('change', function(){
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
                                            <div class="title">
                            <span class="f-s_0">
                                <span class="icon-arrow"></span>
                                <span class="d_b">
                                    <span class="text-el"><?php echo $char->title; ?></span>
                                </span>
                            </span>
                                            </div>
                                            <div class="filters-content">
                                                <ul>
                                                    <?php
                                                    foreach ($char->getCharacteristicItems()->all() as $itemm) {?>
                                                        <li>
                                                            <div class="frame-label" id="brand_281">

                                                                <?php $chr = new common\models\CharacteristicItem();
                                                                echo $form->field($chr, '['. $i .']characteristic_id')->hiddenInput(['value' => $char->id])->label('');
                                                                if (isset($selected[$i]['value'])) {
                                                                    echo $form->field($chr, '[' . $i . ']value')->input('checkbox', ['value' => $itemm->value, 'checked ' => ''])->label($itemm->value);
                                                                } else {
                                                                    echo $form->field($chr, '[' . $i . ']value')->input('checkbox', ['value' => $itemm->value])->label($itemm->value);
                                                                }
                                                                ?>
                                                            </div>
                                                        </li>
                                                        <?php $i = $i + 1; }?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                <?php }}?>

                            <div class="filter-foot">
                                <div class="inside-padd t-a_c">
                                    <div class="btn-form">
                                        <?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'button']);?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php ActiveForm::end();
                }?>

                <script>
                </script>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://active.imagecmsdemo.net/templates/active/js/cusel-min-2.5.js"></script>                </div>
<div class="h-footer"></div>