<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model common\models\Stock */
/* @var $form yii\widgets\ActiveForm */
/* @var $arrayItems array */
?>

<div class="stock-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

    echo $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

    <div style="width: 47%; float:left;margin-right: 6%">
        <?php echo $form->field($model, 'date_from')->widget(DateControl::classname(), [
            'ajaxConversion' => false,
            'type' => DateControl::FORMAT_DATETIME,
            'options' => [
                'pluginOptions' => [
                    'autoclose' => true
                ],
            ]
        ]); ?>
    </div>

    <div style="width: 47%; float:left;">
        <?php echo $form->field($model, 'date_to')->widget(DateControl::classname(), [
            'ajaxConversion' => false,
            'type' => DateControl::FORMAT_DATETIME,
            'options' => [
                'pluginOptions' => [
                    'autoclose' => true
                ],
            ]
        ]); ?>
    </div>

    <?php echo $form->field($model, 'description')->textarea(['rows' => 4]); ?>

    <div style="width: 47%; float:left;margin-right: 6%">
        <?php echo $form->field($model, 'type')->dropDownList(['1' => 'Проценты', '2' => 'Фиксированный']); ?>
    </div>

    <div style="width: 47%; float:left;">
        <?php echo $form->field($model, 'value')->textInput(); ?>
    </div>

    <div style="float: left;width: 100%;padding-bottom: 15px;">
        <label class="control-label">Товары, участвующие в акции</label>
        <?php $configs = [
            'name' => 'items',
            'data' => $arrayItems,
            'theme' => Select2::THEME_DEFAULT,
            'options' => [
                'placeholder' => '',
                'multiple' => true
            ],
        ];
        if (isset($selected)) {
            $configs['value'] = $selected;
        }
        echo Select2::widget($configs); ?>
    </div>

    <?php $images = [];
    if (!$model->isNewRecord && !empty($model->image)) {
        $images[] = Html::img($model->getImageUrl(), ['width' => '120px']);
    }
    echo $form->field($model, 'imageFile')->widget(FileInput::classname(), [
        'model' => $model,
        'attribute' => 'imageFile',
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
    <br>
    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
