<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'largeTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?php
    $image = [];
    if (!$model->isNewRecord && !empty($model->image)) {
    $image = Html::img($model->getImageUrl(), ['width' => '120px']);
    }
    ?>
    <?= $form->field($model, 'imageFile')->widget(FileInput::classname(), [
        'options' => [
            'multiple' => false,
        ],
        'pluginOptions' => [
            'initialPreview' => $image,
            'initialPreviewConfig' => [
                'width' => '120px'
            ],
            'showUpload' => false,
            'overwriteInitial' => true,
            'maxFileCount' => 1
        ]
    ]);  ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>