<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Stock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]);

    //echo $form->field($model, 'date_from')->textInput();

    //echo $form->field($model, 'date_to')->textInput();

    echo $form->field($model, 'description')->textarea(['rows' => 6]);

    echo $form->field($model, 'type')->dropDownList(['1' => 'Проценты', '2' => 'Фиксированный']);

    echo $form->field($model, 'value')->textInput();

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
    echo Select2::widget($configs);?>
    <br>
    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
