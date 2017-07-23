<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $characteristics \common\models\Characteristic[] */
/* @var $selected array */
/* @var $category \common\models\ItemCat */
?>
<div class="sidebar grid__item large--one-quarter">
    <div class="collection-sidebar">
        <div class="filter-blocks widget">
            <h4 class="widget__title">Фильтры</h4>
            <?php $form = ActiveForm::begin([
                'method' => 'get',
                'action' => $category->getUrl(),
                'id' => 'filterForm'
            ]); ?>
            <div class="widget__content">
                <?php $i = 0;
                foreach ($characteristics as $characteristic) :
                    if (!empty($characteristic->characteristicItems)) : ?>
                    <div class="filter-block filter-custom filter-tag">
                        <h5 class="filter-title">
                            <?= $characteristic->title ?><a href="javascript:void(0)" class="clear" style="display:none">x</a>
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
                                                    && in_array($characteristicItem->value, $selected[$characteristic->id])) {
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
                <?php endif;
                endforeach; ?>
                <?= Html::submitButton('Фильтровать', ['class' => 'btn']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
