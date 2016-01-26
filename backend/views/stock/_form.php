<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Stock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

    echo $form->field($model, 'title')->textInput(['maxlength' => true]);

    echo $form->field($model, 'date_from')->textInput();

    echo $form->field($model, 'date_to')->textInput();

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
    echo Select2::widget($configs);

    echo '<br>';
    $images = [];
    if (!$model->isNewRecord && !empty($model->image)) {
        $images[] = Html::img($model->getImageUrl(), ['width' => '120px']);
    }
    echo FileInput::widget([
        'model' => $model,
        'attribute' => 'imageFile',
        'options'=>[
            'multiple' => false,
        ],
        'pluginOptions' => [
            'initialPreview' => $images,
            'initialPreviewConfig' => [
                'width' => '120px'
            ],
            'showUpload' => false,
            'overwriteInitial' => false,
            'maxFileCount' => 1
        ]
    ]);
    ?>
    <br>
    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
