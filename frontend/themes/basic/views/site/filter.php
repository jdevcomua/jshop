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
    $form = ActiveForm::begin([
        'method' => 'get',
        'action' => $category->getUrl(),
        'id' => 'filterForm'
    ]);
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
                                        class="filters-content <?= !array_key_exists($char->id, $selected) ? 'd_n' : ''; ?>">
                                        <ul>
                                            <?php foreach ($char->characteristicItems as $characteristicItem) {
                                                if (!empty($characteristicItem->value)) { ?>
                                                    <li>
                                                        <div class="frame-label" id="brand_281">
                                                            <?php
                                                            if (array_key_exists($char->id, $selected) && in_array($characteristicItem->value, $selected[$char->id])) {
                                                                $checked = true;
                                                            } else {
                                                                $checked = false;
                                                            }
                                                            echo Html::checkbox('filter[' . $char->id . '][]', $checked, [
                                                                'value' => $characteristicItem->value,
                                                                'disabled' => ($characteristicItem->count == 0 && !$checked),
                                                                'label' => $characteristicItem->value .
                                                                    Html::tag('span', ' (' . $characteristicItem->count . ')'
                                                                        , ['class' => 'count'])
                                                            ]);
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
                            <?php echo Html::submitButton('<span class="text-el" style="color: #000;" c>' . \Yii::t("app", "Фильтровать") . '</span>'); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end();
}