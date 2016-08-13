<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Kit */
/* @var $form yii\widgets\ActiveForm */
/* @var $arrayItems array */
/* @var $mainItem \common\models\Item */

$configs = [
    'name' => 'items',
    'data' => $arrayItems,
    'theme' => Select2::THEME_DEFAULT,
    'options' => [
        'placeholder' => '',
        'multiple' => true,
    ],
];
if (isset($selected)) {
    $configs['value'] = $selected;
}
$configsMain = [
    'name' => 'mainItem',
    'data' => $arrayItems,
    'theme' => Select2::THEME_DEFAULT,
    'options' => [
        'placeholder' => '',
        'multiple' => false,
        'required' => true,
    ],
];
if (isset($mainItem)) {
    $configsMain['value'] = $mainItem->id;
}
?>

<div class="kit-form">

    <?php $form = ActiveForm::begin();

    echo $form->field($model, 'title')->textInput(['maxlength' => true]);

    echo $form->field($model, 'description')->textarea(['rows' => 4]);

    echo $form->field($model, 'cost')->textInput(); ?>

    <div class="form-group">
        <label class="control-label">Главный товар</label>
        <?= Select2::widget($configsMain); ?>
    </div>

    <div class="form-group">
        <label class="control-label">Прикрепленные товары</label>
        <?= Select2::widget($configs); ?>
    </div>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Сохранить'), [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
