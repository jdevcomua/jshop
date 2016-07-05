<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\typeahead\Typeahead;

$form = ActiveForm::begin();?>
<div style="width: 100%; padding-left: 15px; margin-top: 20px;">
<?php foreach ($characteristics as $index => $characteristic) {
    if (isset($characteristic->characteristic_id)) {
        /* @var $characteristic common\models\CharacteristicItem */?>
        <div style="width: 500px; float:left; padding-right: 50px;">
        <?php //echo $form->field($characteristic, "[$index]value")->label($characteristic->getCharacteristicTitle());?>
        <?php $charItems = $characteristic->characteristic->getCharacteristicItems()->all();
        $typehead = [];
        foreach ($charItems as $charItem) {
            $typehead[] = $charItem->value;
        }
        if (empty($typehead)) {
            echo $form->field($characteristic, "[$index]value")->label($characteristic->getCharacteristicTitle());
        } else {
            echo $form->field($characteristic, "[$index]value")->widget(Typeahead::classname(), [
                'options' => ['placeholder' => ''],
                'pluginOptions' => ['highlight' => true],
                'dataset' => [
                    [
                        'local' => $typehead,
                        'limit' => 10
                    ]
                ]
            ])->label($characteristic->getCharacteristicTitle());
        }

        ?>
        </div>
        <?php
    }
}?>
</div>
<div style="width: 100%; padding-left: 15px; float: right;" class="form-group">
<?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'button']);?>
</div>

<?php ActiveForm::end(); ?>