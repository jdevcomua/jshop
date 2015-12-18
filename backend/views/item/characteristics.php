<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Characteristic;

$form = ActiveForm::begin();
echo "<div style=\"width: 100%; padding-left: 15px; margin-top: 20px;\">";
foreach ($characteristics as $index => $characteristic) {
    if(isset($characteristic->characteristic_id)) {
        /* @var $characteristic common\models\CharacteristicItem */
        echo "<div style=\"width: 500px; float:left; padding-right: 50px;\">";
        echo $form->field($characteristic, "[$index]value")->label($characteristic->getCharacteristicTitle());
        echo "</div>";
    }
}
echo "</div>";
echo "<div style=\"width: 100%; padding-left: 15px; float: right;\" class=\"form-group\">";
echo Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'button']);
echo "</div>";

ActiveForm::end();
?>