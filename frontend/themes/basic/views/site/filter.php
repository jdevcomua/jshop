<?php

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
        'action' => Yii::$app->urlHelper->to(['category/' . $category->id . '-' . $category->getTranslit()]),
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
                            foreach ($char as $value) { ?>
                                <li class="clear-filter" data-value="<?= $value; ?>" data-id="<?= $key; ?>">
                                    <button type="button">
                                        <span class="icon_times icon_remove_filter f_l"></span>
                                        <span class="name-check-filter">
                                            <?= $chars[$key]->title; ?>: <?= $value; ?>
                                        </span>
                                    </button>
                                </li>
                        <?php }
                        } ?>
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
                        <script>
                            var slider = document.getElementById('slider');
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
                /* @var $char \common\models\Characteristic */
                foreach ($chars as $char) {
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
}