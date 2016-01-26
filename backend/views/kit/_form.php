<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Kit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kit-form">

    <?php $form = ActiveForm::begin();

    echo $form->field($model, 'title')->textInput(['maxlength' => true]);

    echo $form->field($model, 'description')->textarea(['rows' => 4]);

    echo $form->field($model, 'cost')->textInput();

    $configs = [
        'name' => 'items',
        'data' => $arrayItems,
        'options' => [
            'placeholder' => 'Select items ...',
            'multiple' => true
        ],
    ];
    if (isset($selected)) {
        $configs['value'] = $selected;
    }

    echo Select2::widget($configs);
    ?>

    <div class="form-group"><br>
        <?php echo Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
