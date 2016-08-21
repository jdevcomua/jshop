<?php

use common\models\Banner;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->dropDownList([Banner::POSITION_INDEX_CENTER => 'Главная страница, центр',
        Banner::POSITION_INDEX_RIGHT => 'Главная страница, справа']) ?>

    <?= $form->field($model, 'enable')->checkbox() ?>

    <?php $images = array();
    if (!$model->isNewRecord && !empty($model->image)) {
        $images[] = Html::img($model->getImageUrl(), ['width' => '120px']);
    }
    echo $form->field($model, 'imageFile')->widget(FileInput::classname(), [
        'options' => [
            'multiple' => false,
        ],
        'pluginOptions' => [
            'initialPreview' => $images,
            'initialPreviewConfig' => [
                'width' => '120px'
            ],
            'showUpload' => false,
            'overwriteInitial' => true,
            'maxFileCount' => 1
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
