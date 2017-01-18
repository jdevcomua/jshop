<style>

    /*filter*/
    .filters-content, .frames-checks-sliders .title{position: relative;}
    .filters-content:before, .frames-checks-sliders .title:before{content: '';border-top: 1px solid transparent;left: 0;top: -10px;position: absolute;width: 100%;}
    .frames-checks-sliders .title:before{top: 100%;}
    .filter-foot{border-top: 1px solid transparent;}
    .frames-checks-sliders .title{border-bottom: 0; font-weight: bold;}
    .frames-checks-sliders .title .text-el{font-weight: bold;}
    .frame-group-checks[data-rel*="dropDown"] .title{background-color: transparent;border-bottom: 0;}
    .frame-check-filter{border: 1px solid transparent;}
    .frame-check-filter .title{font-size: 13px;border-bottom: 1px solid transparent;}

    .foot-check-filter{border-top: 1px solid transparent;}
    .frames-checks-sliders{border: 1px solid transparent;border-bottom-width: 2px;}

    .frames-checks-sliders > .frame-group-checks{border-top: 1px solid transparent;}
    .frames-checks-sliders > .frame-group-checks:first-child{border-top: 0;}
    .frame-group-checks .title .d_l{display: inline;}
    .frame-group-checks .icon-arrow{border-width: 0;display: none;}
    .frame-group-checks[data-rel*="dropDown"] .icon-arrow{float: left;display: block;}
    .frame-group-checks[data-rel*="dropDown"] .icon-arrow + .d_b{margin-left: 13px;}
    .frame-group-checks[data-rel*="dropDown"] .f-s_0:hover .icon-arrow{background-position: -480px -20px;}
    .frame-group-checks[data-rel*="dropDown"] .f-s_0.valuePD .icon-arrow{background-position: -500px 0;}
    .frame-group-checks[data-rel*="dropDown"] .f-s_0.valuePD:hover .icon-arrow{background-position: -500px -20px;}

    .apply{border-radius: 2px;}
    .apply .description{font-size: 11px;}
    .apply:before{border-style: solid;border-width: 3px;border-color: transparent;}
    .apply.left:before{border-right-color: transparent;}
    /*/filter*/

    .frame-filter{margin-bottom: 27px;}
    .filter-foot{padding: 9px 0 10px;}
    .frame-check-filter{overflow: hidden;margin-bottom: 18px;}
    .list-check-filter{padding: 9px 12px 7px;}
    .list-check-filter > li{overflow: hidden;margin-bottom: 7px;}
    .frame-check-filter .title{padding: 5px 12px;}
    .name-check-filter{margin-left: 23px;display: block;line-height: 1.2;text-align: left;}
    .foot-check-filter{position: relative;overflow: hidden;}
    .check-filter{margin: 0 0 8px;}
    .check-filter li{margin-bottom: 1px;}
    .check-filter > li > div{margin-left: 16px;}

    .frames-checks-sliders .title{padding: 6px 12px 9px;}
    .frame-slider .title{margin-right: -15px;margin-left: -15px;}
    .frame-slider .filters-content {padding-top: 10px;}

    .slider-cont{margin: 31px 0 19px 10px;position: relative;}
    .slider {position: relative;height: 5px;}
    .left-slider{margin-left: -11px;}
    .right-slider{margin-left: -11px;}
    .form-cost{margin-bottom: 16px;}
    .form-cost label{width: 95px;}

    .ui-widget-header{position: absolute;z-index: 1;height: 6px;top: -1px;}
    .frame-slider .inside-padd{padding: 0 15px;}

    .frame-group-checks[data-rel]{display: none;}
    .frame-group-checks[data-rel*="scroll"] .filters-content{max-height: 159px;overflow: auto;}
    .frame-group-checks[data-rel*="dropDown"] .filters-content{display: none;}
    .frame-group-checks[data-rel*="dropDown"] .title > .f-s_0{cursor: pointer;}
    .frame-group-checks[data-rel="cusel"] .inside-padd{padding-right: 20px;}
    .frame-group-checks .inside-padd{padding: 0;}
    .frame-group-checks .frame-label{cursor: pointer;display: inline-block;margin-bottom: 6px;}

    .filters-content{margin: 10px 0;}
    .filters-content ul{padding: 0 0 0 12px;}


    /*filter*/
    .filters-content:before, .frames-checks-sliders .title:before{border-top-color: #e9e9e9;}
    .filter-foot{border-top-color: #e9e9e9;}
    .frames-checks-sliders .title{background-color: #fafafa;}
    .name-check-filter{color: #333;}
    .frame-check-filter{border-color: #e6e6e6;}
    .frame-check-filter .title{background-color: #fafafa;color: #333;border-bottom-color: #e6e6e6;}

    .foot-check-filter{border-top-color: #e6e6e6;}
    .frames-checks-sliders{border-color: #efece8;}
    .clear-filter > button:hover .text-el, .clear-price > button:hover .text-el{color: #51d2ff;}

    .check-filter li{color: #eb6b2b;}
    .check-filter li.ref:hover{color: #eba92b;}
    .frames-checks-sliders > .frame-group-checks{border-top-color: #eae5e1;}

    .apply{background-color: #4c4c4c;}
    .apply .description{color: #fff;}
    .apply a{color: #34a4e7;}
    .apply a:hover{color: #fff;}
    .apply:before{border-right-color: #4c4c4c;}
    .apply.left:before{border-left-color: #0c9acb;}
    /*/filter*/

    .slider-cont{margin: 31px 0 19px 10px;position: relative;}
    .slider {height: 7px;}
    .left-slider{margin-left: -11px;}
    .right-slider{margin-left: -11px;}
    .form-cost{margin-bottom: 16px;}
    .form-cost label{width: 95px;}

    .slider-input {
        width:75px;
        border: 1px solid #dfdfdf;
        padding: 0 5px;
        height: 31px;
    }

    .slider-input-left {
        margin-left: 25px;
    }

    .slider-input-right {
        margin-bottom: 15px;
    }

    .t-a_c {
        text-align: center !important;
    }
    .btn-form > input, .btn-form > button {
        height: 29px;
        line-height: 29px;
        padding: 0 22px;
    }
    .btn-form {
        border: 1px solid transparent;
    }

    [class*="btn-"], .buti {
        vertical-align: middle;
    }
    [class*="btn-"], .buti {
        display: inline-block;
        position: relative;
        font-size: 0;
    }
    .btn-form{border-color: #cfcfcf; background: #fff;}

    [class*="btn"] > button, [class*="btn"] > a, .buti > button, .buti > a {
        cursor: pointer;
        display: inline-block;
        font-size: 0 !important;
    }
    label, input[type="button"], input[type="submit"], input[type="reset"], button {
        padding: 0;
        cursor: pointer;
    }
    input[type="button"], input[type="submit"], input[type="reset"], button {
        text-align: center;
    }
    input[type="submit"], input[type="reset"], input[type="button"], button {
        -webkit-appearance: button;
        overflow: visible;
        background-color: transparent;
        border: none;
    }

    ul, ol {
        list-style: none;
    }
    /*not standart checkbox radio*/
    .frame-label:hover .niceCheck{background-position: -560px -20px;}
    .niceCheck{float: left;position: relative;top: 1px;margin-right: 5px;background-position: -560px 0;width: 14px;height: 14px;}
    .niceCheck.active{background-position: -580px 0;}
    .frame-label:hover .niceCheck.active{background-position: -580px -20px;}
    .frame-label .nstcheck.niceCheck.disabled{background-position: -600px 0;}
    .niceCheck input, .niceRadio input{display: none;}
    .b_n.niceCheck, .b_n.niceRadio{background: none;}
    .b_n.niceCheck input, .b_n.niceRadio input{display: block;}
    .niceCheck + .name-count{margin-left: 21px;padding-right: 18px;}
    .niceRadio + .name-count{margin-left: 19px;margin-right: 20px;}
    .niceCheck + .name-count + .help-block{margin-left: 21px;}
    .niceRadio + .name-count + .help-block{margin-left: 19px;}

    .niceRadio{float: left;position: relative;top: 2px;margin-right: 5px;width: 14px;height: 14px;background-position: -1040px 0;}
    .niceRadio.active{background-position: -1040px -20px;}
    .frame-radio .frame-label:hover .niceRadio{background-position: -1040px -40px;}
    /*/not standart checkbox radio*/
    [class*="icon_"], [class*="icon-"], .ui-slider-handle, .product-status, .niceCheck, .niceRadio, .cuselFrameRight, .btn-to-up{background: url("../imgage/sprite.png") no-repeat;}
</style>

<?php

use common\models\Characteristic;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $category \common\models\ItemCat */
/* @var $this yii\web\View */
/* @var $chars \common\models\Characteristic[] */
/* @var $sort string */
/* @var $selected array */
/* @var $maxCost string|mixed */
/* @var $minCost string|mixed */
/* @var $leftCost string|mixed */
/* @var $rightCost string|mixed */
/* @var $filterCounts array */

if (($category->id != '0') && ($category->getItems()->count() > 1)) {
    echo Html::input('hidden', 'sort', $sort, ['id' => 'sort_input'])
    ?>
    <div class="filter left-catalog">
        <?php if (count($selected) > 0) { ?>
            <div class="frame-check-filter">
                <div class="inside-padd">
                    <div class="title">Выбранные фильтры:</div>
                    <ul class="list-check-filter">
                        <?php foreach ($selected as $key => $char) {
                            if ($chars[$key]->type == Characteristic::TYPE_RANGE) {
                                $leftSet = key_exists('left', $char);
                                $rightSet = key_exists('right', $char);
                                if ($leftSet) { ?>
                                    <li class="clear-filter" data-type="range" data-value="left" data-id="<?= $key; ?>">
                                        <button type="button">
                                            <span class="icon_times icon_remove_filter f_l"></span>
                                            <span class="name-check-filter">
                                                <?= $chars[$key]->title; ?>: от <?= $char['left']; ?>
                                            </span>
                                        </button>
                                    </li>
                                <?php }
                                if ($rightSet) { ?>
                                        <li class="clear-filter" data-type="range" data-value="right" data-id="<?= $key; ?>">
                                            <button type="button">
                                                <span class="icon_times icon_remove_filter f_l"></span>
                                                <span class="name-check-filter">
                                                    <?= $chars[$key]->title; ?>: до <?= $char['right']; ?>
                                                </span>
                                            </button>
                                        </li>
                                    <?php }
                            } else { ?>
                                <?php foreach ($char as $value) { ?>
                                    <li class="clear-filter" data-type="checkbox" data-value="<?= $value; ?>" data-id="<?= $key; ?>">
                                        <button type="button">
                                            <span class="icon_times icon_remove_filter f_l"></span>
                                            <span class="name-check-filter">
                                                <?= $chars[$key]->title; ?>: <?= $value; ?>
                                            </span>
                                        </button>
                                    </li>
                                <?php }
                            }
                        }?>
                    </ul>
                    <div class="foot-check-filter">
                        <button type="button" onclick="location.href = location.origin + location.pathname"
                                class="btn-reset-filter">
                            <span class="icon_times icon_remove_all_filter f_l"></span>
                            <span class="text-el d_l_2">Сбросить все параметры</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="frame-filter p_r">
            <div class="preloader wo-i" style="display: none;"></div>
            <div id="slider-range"></div>
            <div class="frames-checks-sliders">
                <div class="frame-slider" data-rel="sliders.slider1">
                    <div class="inside-padd">
                        <div class="title"><?php echo \Yii::t('app', 'Фильтр по цене'); ?></div>
                        <br>
                        <div class="slider" id="slider"></div>
                        <br>
                        <script>
                            var slider = document.getElementById('slider');
                            noUiSlider.create(slider, {
                                start: [<?= $leftCost ?>, <?= $rightCost ?>],
                                connect: true,
                                range: {
                                    'min': <?= $minCost ?>,
                                    'max': <?= $maxCost ?>
                                }
                            });
                        </script>
                        <input name="left" type="number" min="<?= $minCost ?>" max="<?= $maxCost ?>"
                               id="input-number-left" class="slider-input slider-input-left">
                        <input name="right" type="number" min="<?= $minCost ?>" max="<?= $maxCost ?>" 
                               id="input-number-right" class="slider-input slider-input-right">
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
                /* @var $char Characteristic */
                foreach ($chars as $char) {
                    if ($char->type == Characteristic::TYPE_CHECKBOXES) {
                        if (!empty($char->characteristicItems)) { ?>
                            <div class="frame-group-checks">
                                <div class="inside-padd">
                                    <div style="cursor: pointer;" class="title" onclick="openFilterContent($(this))">
                                    <span class="f-s_0">
                                        <span class="icon-arrow"></span>
                                        <span class="d_b">
                                            <span class="text-el"><?php echo $char->title; ?>
                                                <img width="10px"
                                                     src="http://rentlytics.com/wp-content/themes/rentlytics/img/arrow-down.png">
                                            </span>
                                        </span>
                                    </span>
                                    </div>
                                    <div
                                        class="filters-content nice-checkbox <?= !array_key_exists($char->id, $selected) ? 'd_n' : ''; ?>">
                                        <ul>
                                            <?php $count = 0;
                                            foreach ($char->characteristicItems as $characteristicItem) {
                                                if (!empty($characteristicItem->value)) { ?>
                                                    <li>
                                                        <div class="frame-label">
                                                            <?php
                                                            if (array_key_exists($char->id, $selected) && in_array($characteristicItem->value, $selected[$char->id])) {
                                                                $checked = true;
                                                            } else {
                                                                $checked = false;
                                                            }
                                                            echo Html::checkbox('filter[' . $char->id . '][]', $checked, [
                                                                'value' => $characteristicItem->value,
                                                                'disabled' => ($characteristicItem->count == 0 && !$checked),
                                                                'id' => 'checkbox' . $char->id . $count,
                                                            ]);
                                                            echo Html::label($characteristicItem->value
                                                                    . Html::tag('span', ' (' . $characteristicItem->count . ')', ['class' => 'count']),
                                                                'checkbox' . $char->id . $count);
                                                            $count++;
                                                            ?>
                                                        </div>
                                                    </li>
                                                    <?php $i = $i + 1;
                                                }
                                            } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else if ($char->type == Characteristic::TYPE_RANGE) {
                        $minMaxValue = $char->getMinMaxValue();
                        $min = $minMaxValue['min'];
                        $max = $minMaxValue['max'];
                        $left = isset($selected[$char->id]['left']) ? $selected[$char->id]['left'] : $min;
                        $right = isset($selected[$char->id]['right']) ? $selected[$char->id]['right'] : $max;
                        if (isset($min) && isset($max)) { ?>
                            <div class="frame-slider">
                                <div class="inside-padd">
                                    <div style="cursor: pointer;" class="title" onclick="openFilterContent($(this))">
                                    <span class="f-s_0">
                                        <span class="d_b">
                                            <span class="text-el"><?php echo $char->title; ?>
                                                <img width="10px"
                                                     src="http://rentlytics.com/wp-content/themes/rentlytics/img/arrow-down.png">
                                            </span>
                                        </span>
                                    </span>
                                    </div>
                                    <div
                                        class="filters-content <?= !array_key_exists($char->id, $selected) ? 'd_n' : ''; ?>">
                                        <div class="slider" id="slider<?= $char->id ?>"></div>
                                        <br>
                                        <script>
                                            var slider<?= $char->id ?> = document.getElementById('slider<?= $char->id ?>');
                                            noUiSlider.create(slider<?= $char->id ?>, {
                                                start: [<?= $left ?>, <?= $right ?>],
                                                connect: true,
                                                range: {
                                                    'min': <?= $min ?>,
                                                    'max': <?= $max ?>
                                                }
                                            });
                                        </script>
                                        <input name="filter[<?= $char->id ?>][left]" type="number" min="<?= $min ?>"
                                               data-value="left" data-id="<?= $char->id; ?>" max="<?= $max ?>"
                                               id="input-number-left<?= $char->id ?>" class="slider-input slider-input-left">
                                        <input name="filter[<?= $char->id ?>][right]" type="number" min="<?= $min ?>"
                                               data-value="right" data-id="<?= $char->id; ?>" max="<?= $max ?>"
                                               id="input-number-right<?= $char->id ?>" class="slider-input slider-input-right">
                                        <script>
                                            var inputNumberLeft<?= $char->id ?> = document.getElementById('input-number-left<?= $char->id ?>');
                                            var inputNumberRight<?= $char->id ?> = document.getElementById('input-number-right<?= $char->id ?>');

                                            slider<?= $char->id ?>.noUiSlider.on('update', function (values, handle) {

                                                var value = values[handle];

                                                if (handle) {
                                                    inputNumberRight<?= $char->id ?>.value = Math.round(value);
                                                } else {
                                                    inputNumberLeft<?= $char->id ?>.value = Math.round(value);
                                                }
                                            });

                                            inputNumberLeft<?= $char->id ?>.addEventListener('change', function () {
                                                slider<?= $char->id ?>.noUiSlider.set([this.value, null]);
                                            });

                                            inputNumberRight<?= $char->id ?>.addEventListener('change', function () {
                                                slider<?= $char->id ?>.noUiSlider.set([null, this.value]);
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                } ?>

                <div class="filter-foot">
                    <div class="inside-padd t-a_c">
                        <div class="btn-form">
                            <?php echo Html::submitButton('<span class="text-el" style="color: #000;font-size: 13px;" c>' . \Yii::t("app", "Фильтровать") . '</span>'); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php } ?>