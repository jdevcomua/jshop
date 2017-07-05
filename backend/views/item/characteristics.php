<?php

use common\models\Characteristic;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\typeahead\Typeahead;

/* @var $characteristics \common\models\Characteristic[] */
/* @var $this \yii\web\View */
/* @var $item \common\models\Item */

$this->title = 'Характеристики товара';
$this->title = Yii::t('app', 'Характеристики товара: ' . $item->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Товары'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $item->title, 'url' => ['view', 'id' => $item->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Характеристики товара</h3>
    </div>
    <div class="box-body">
        <?php $form = ActiveForm::begin(); ?>
        <div>
            <?php foreach ($characteristics as $index => $characteristic) {
                if (isset($characteristic->characteristic_id)) {
                    /* @var $characteristic common\models\CharacteristicItem */ ?>
                    <div style="width: 500px; float:left; padding-right: 50px;">
                        <?php //echo $form->field($characteristic, "[$index]value")->label($characteristic->getCharacteristicTitle());?>
                        <?php $char = $characteristic->characteristic;
                        $charItems = $char->getCharacteristicItems()->all();
                        $typehead = [];
                        foreach ($charItems as $charItem) {
                            $typehead[] = $charItem->value;
                        }
                        $type = $char->type == Characteristic::TYPE_RANGE ? 'number' : 'text';
                        if (empty($typehead)) {
                            echo $form->field($characteristic, "[$index]value")->input($type)->label($characteristic->getCharacteristicTitle());
                        } else {
                            echo $form->field($characteristic, "[$index]value")->widget(Typeahead::classname(), [
                                'options' => ['placeholder' => '', 'type' => $type],
                                'pluginOptions' => ['highlight' => true],
                                'dataset' => [
                                    [
                                        'local' => $typehead,
                                        'limit' => 10
                                    ]
                                ]
                            ])->label($characteristic->getCharacteristicTitle());
                        } ?>
                    </div>
                <?php }
            } ?>
            <div class="clear"></div>
        </div>
        <div class="form-group">
            <?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'button']); ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>