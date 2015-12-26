<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ItemCat;
use yii\helpers\Url;
?>

<div class="frame-menu-main horizontal-menu">
    <!--    menu-row-category || menu-col-category-->
    <div class="menu-main menu-row-category container">
        <nav>
            <table>
                <tbody>
                <tr><td><div class="frame-item-menu"><div class="frame-title"><a href="?category=0" class="title" style="color: #fff;"><span class="helper" style="height: 43px;"></span><span><span class="text-el">all</span></span></a></div></div></td>
                    <?php
                    foreach ($allCategories as $i => $value) {
                        echo "<td><div class=\"frame-item-menu\"><div class=\"frame-title\"><a href=\"?category=";
                        echo $value['id'];
                        echo "\" class=\"title\" style=\"color: #fff;\">";
                        echo "<span class=\"helper\" style=\"height: 43px;\"></span><span><span class=\"text-el\">";
                        echo $value['title'];
                        echo "</span></span></a></div></div></td>";
                    }
                    ?>
                </tr>
                </tbody>
            </table>
        </nav>
    </div></div>
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
                        echo "</span> $</span></span></span></div>";
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
                                    <div class="slider-cont">
                                        <noscript>Джаваскрипт не включен</noscript>
                                        <div class="slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="slider1" aria-disabled="false">
                                            <a href="#" class="ui-slider-handle left-slider ui-state-default ui-corner-all" style="left: 0%;"></a>
                                            <a href="#" class="ui-slider-handle right-slider ui-state-default ui-corner-all" style="left: 100%;"></a>
                                            <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div></div>
                                    </div>
                                    <div class="form-cost number">
                                        <div class="t-a_j">
                                            <label>
                                                <input type="text" class="minCost" data-title="только цифры" name="lp" value="8" data-mins="8">
                                            </label>
                                            <label>
                                                <input type="text" class="maxCost" data-title="только цифры" name="rp" value="60" data-maxs="60">
                                            </label>
                                            <div class="btn-def d_n">
                                                <input type="submit" value="ОК">
                                            </div>
                                        </div>
                                    </div>
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