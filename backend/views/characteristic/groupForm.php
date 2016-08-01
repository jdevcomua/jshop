<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $models \common\models\Characteristic[] */
?>

<div class="characteristic-form">

    <?php $form = ActiveForm::begin(); ?>
    <div style="width: 100%; padding-left: 15px; margin-top: 20px;">
        <?php /* @var $characteristic common\models\Characteristic */
        foreach ($models as $index => $characteristic) { ?>
            <div style="width: 500px; float:left; padding-right: 50px;">
                <?= $form->field($characteristic, "[$index]title")->label($characteristic->title . ' -> ' . $characteristic->getCategoryTitle()); ?>
            </div>
        <?php } ?>
    </div>
    <div style="width: 100%; padding-left: 15px; float: right;" class="form-group"
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'button']); ?>

<?php ActiveForm::end(); ?>

</div>
