<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $category \common\models\ItemCat*/
/* @var $this yii\web\View */
?>

<div class="content">
    <br>
    <div class="frame-inside page-category">
        <div class="container">
            <?php if (!empty($category->children)) { ?>
            <div class="">
                <!-- Start. Category name and count products in category-->
                <div class="f-s_0 title-category">
                    <div class="frame-title">
                        <h1 class="title"><?php echo $category->title; ?></h1>
                    </div>
                </div>
                <!-- End. Category name and count products in category-->
                <!--Start. Banners block-->

                <!--End. Banners-->
                <ul class="animateListItems items items-catalog  table" id="items-catalog-main">

                    <?php
                    foreach ($category->children as $value) {
                        /* @var $value \common\models\ItemCat */
                        ?>
                        <li class="globalFrameProduct to-cart" style="height: 210px;width: 20% !important;">
                            <a href="<?php echo Yii::$app->urlHelper->to(['category/' . $value->id . '-' . $value->getTranslit()]); ?>"
                               class="frame-photo-title">
                                <span class="photo-block"><span class="helper"></span><img
                                        src="<?php echo $value->getImageUrl(); ?>"></span>
                                <span class="title" style="font-size: 14px; font-weight: bold;"><?php echo $value['title']; ?></span></a>
                                    <div class="decor-element"
                                         style="height: 200px; width: 100%; position: absolute; right: auto; left: 0px; bottom: auto; top: 0px;">
                                    </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php } ?>
            <?php if (isset($category) && ($category->getItems()->count() > 0)) { ?>
            <div class="right-catalog">
                <!-- Start. Category name and count products in category-->
                <div class="f-s_0 title-category">
                    <div class="frame-title">
                        <h1 class="title"><?php echo $category->title; ?></h1>
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
                                <ul class="nav-sort nav f_l" id="sort">
                                    <li>
                                        <a href="?sort=promotions"
                                           class="d_l_3"><?php echo \Yii::t('app', 'Акции'); ?></a>
                                    </li>
                                    <li><a href="?sort=asc"
                                           class="d_l_3"><?php echo \Yii::t('app', 'От дешевых к дорогим'); ?></a>
                                    </li>
                                    <li><a href="?sort=desc"
                                           class="d_l_3"><?php echo \Yii::t('app', 'От дорогих к дешевым'); ?></a>
                                    </li>
                                    <li>
                                        <a href="?sort=top"
                                           class="d_l_3"><?php echo \Yii::t('app', 'Популярные'); ?></a>
                                    </li>
                                    <li>
                                        <a href="?sort=rating"
                                           class="d_l_3"><?php echo \Yii::t('app', 'Рейтинг'); ?></a>
                                    </li>
                                    <li>
                                        <a href="?sort=new"
                                           class="d_l_3"><?php echo \Yii::t('app', 'Новинки'); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php
                        $dataProvider = new \yii\data\ActiveDataProvider([
                            'query' => $items
                        ]);
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('item', ['value' => $model]);
                            },
                            'options' => [
                                'tag' => 'ul',
                                'class' => 'animateListItems items items-catalog  table" id="items-catalog-main',
                            ],
                            'itemOptions' => [
                                'tag' => 'li',
                                'class' => 'globalFrameProduct to-cart',
                            ],
                        ]);
                        ?>
            </div>
            <?php if (($category->id != '0') && ($category->getItems()->count() > 1)) {

            $form = ActiveForm::begin(); ?>
            <div class="filter left-catalog">

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
                                if (!empty($char->characteristicItems)) {

                                    ?>

                                    <div class="frame-group-checks">
                                        <div class="inside-padd">
                                            <div style="cursor: pointer;" class="title" onclick="openFilterContent($(this))">
                                                <span class="f-s_0">
                                                    <span class="icon-arrow"></span>
                                                    <span class="d_b">
                                                        <span class="text-el"><?php echo $char->title; ?> <img
                                                                width="10px"
                                                                src="http://rentlytics.com/wp-content/themes/rentlytics/img/arrow-down.png"></span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="filters-content <?php echo !array_key_exists($char->id, $selected) ? 'd_n' : ''; ?>">
                                                <ul>
                                                    <?php
                                                    foreach ($char->characteristicItems as $itemm) {
                                                        if (!empty($itemm->value)) {
                                                            ?>
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
                                                        }
                                                    }?>
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

            </div>
                <?php ActiveForm::end();
            } ?>
            <?php }?>
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
                                    <?php if (!empty($wishLists)) {?>
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