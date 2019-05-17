<?php
use kartik\slider\Slider;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $characteristics \common\models\Characteristic[] */
/* @var $selected array */
/* @var $category \common\models\ItemCat */
/* @var $sort string */
/* @var $minCost float */
/* @var $maxCost float */
/* @var $leftCost float */
/* @var $rightCost float */

$sliderStopJS = <<<JS
    function f () {
        var value = $(this).slider('getValue');
        var left = value[0];
        var right = value[1];
        console.log($(this), left, right);
        $('input[name=left]').attr('value', left);
        $('input[name=right]').val(right);
    }
JS;

$inputJS = <<<JS
    $('.slider-input-left').change(function() {
        var value = $('#cost-slider').slider('getValue');
        var left = +$(this).val();
        if (left != value[0]) {
            $('#cost-slider').slider('setValue', [left, value[1]]);
        }
    });
    $('.slider-input-right').change(function() {
        var value = $('#cost-slider').slider('getValue');
        var right = +$(this).val();
        if (right != value[1]) {
            $('#cost-slider').slider('setValue', [value[0], right]);
        }
    });
JS;
$this->registerJs($inputJS);
?>
<div class="sidebar grid__item large--one-quarter">
    <div class="collection-sidebar">
        <div class="filter-blocks widget">
            <h4 class="widget__title"><?=Yii::t('app', 'Filters')?></h4>
            <?php $form = ActiveForm::begin([
                'method' => 'get',
                'action' => $category->getUrl(),
                'id' => 'filterForm'
            ]); ?>
            <?= Html::input('hidden', 'sort', $sort, ['id' => 'sort_input']) ?>
            <div class="widget__content">
                <div class="filter-block filter-custom filter-tag" style="width: 90%">
                    <h5 class="filter-title">Price</h5>
                    <p class="text-center">
                        <input name="left" type="number" min="<?= $minCost ?>" max="<?= $maxCost ?>"
                               id="input-number-left" class="slider-input slider-input-left" value="<?= $leftCost ?>">
                        -
                        <input name="right" type="number" min="<?= $minCost ?>" max="<?= $maxCost ?>"
                               id="input-number-right" class="slider-input slider-input-right"
                               value="<?= $rightCost ?>">
                    </p>
                    <?= Slider::widget([
                        'name' => '',
                        'value' => (int)$leftCost . ',' . (int)$rightCost,
                        'sliderColor' => Slider::TYPE_GREY,
                        'handleColor' => Slider::TYPE_SUCCESS,
                        'pluginOptions' => [
                            'min' => (int)$minCost,
                            'max' => (int)$maxCost,
                            'range' => true
                        ],
                        'pluginEvents' => [
                            "slideStop" =>
                                $sliderStopJS,
                        ],
                        'options' => [
                            'id' => 'cost-slider',
                        ],
                    ]); ?>
                </div>
                <?php $i = 0;
                foreach ($characteristics as $characteristic) :
                    if (!empty($characteristic->characteristicItems)) : ?>
                        <div class="filter-block filter-custom filter-tag">
                            <h5 class="filter-title">
                                <?= $characteristic->title ?>
                                <a href="javascript:void(0)" class="clear" style="display:none">x</a>
                            </h5>
                            <div class="filter-content">
                                <ul>
                                    <?php $count = 0;
                                    foreach ($characteristic->characteristicItems as $characteristicItem) {
                                        if (!empty($characteristicItem->value)) { ?>
                                            <li>
                                                <div class="frame-label checkbox">
                                                    <?php
                                                    if (array_key_exists($characteristic->id, $selected)
                                                        && in_array($characteristicItem->value, $selected[$characteristic->id])
                                                    ) {
                                                        $checked = true;
                                                    } else {
                                                        $checked = false;
                                                    }
                                                    $checkbox = Html::checkbox('filter[' . $characteristic->id . '][]', $checked, [
                                                        'value' => $characteristicItem->value,
                                                        'disabled' => ($characteristicItem->count == 0 && !$checked),
                                                        'id' => 'checkbox' . $characteristic->id . $count,
                                                        'class' => 'input-checkbox',
                                                    ]);
                                                    echo Html::label($checkbox . $characteristicItem->value
                                                        . Html::tag('span', ' (' . $characteristicItem->count . ')', ['class' => 'count']),
                                                        'checkbox' . $characteristic->id . $count);
                                                    $count++; ?>
                                                </div>
                                            </li>
                                            <?php $i = $i + 1;
                                        }
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif;
                endforeach; ?>
                <?= Html::submitButton('Filter', ['class' => 'btn']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
