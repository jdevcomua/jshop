<?php

use yii\helpers\Html;
use unclead\multipleinput\TabularInput;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCat */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories array */
/* @var $categories array */
?>

<div class="item-cat-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

    echo $form->field($model, 'title')->textInput(['maxlength' => true]);
    
    echo $form->field($model, 'active')->checkbox();

    echo $form->field($model, 'parent_id')->widget(Select2::classname(), [
        'data' => $categories,
        'options' => ['placeholder' => ''],
        'theme' => Select2::THEME_DEFAULT,
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    echo  TabularInput::widget([
        'models' => $model->parse,
        'attributeOptions' => [
            'enableAjaxValidation'      => false,
            'enableClientValidation'    => false,
            'validateOnChange'          => false,
            'validateOnSubmit'          => true,
            'validateOnBlur'            => false,
        ],
        'columns' => [
            [
                'name'  => 'url',
                'title' => 'url',
                'type'  => \unclead\multipleinput\MultipleInputColumn::TYPE_TEXT_INPUT,
            ],
        ]
    ]);
    ?>
    <div class="box-header with-border">
        <h3 class="box-title">Seo</h3>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($seo, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($seo, 'description')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($seo, 'keywords')->textInput(['maxlength' => true])->label('Keywords (comma separated)') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($seo, 'h1')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($seo, 'new_url')->textInput(['maxlength' => true])->label('New URL(Фраза после которая находиться после номера элемента)') ?>
        </div>
        <div class="col-md-6">

        </div>
    </div>
    <?php
    $images = [];
    if (!$model->isNewRecord && !empty($model->image)) {
        $images[] = Html::img($model->getImageUrl(), ['width' => '120px']);
    }
    echo $form->field($model, 'image')->widget(
        \backend\widget\CropWidget\CropWidget::className(), [
        'uploadUrl' => \yii\helpers\Url::toRoute('/item/uploadPhoto'),
        'noPhotoImage' => ($model->isNewRecord) ? '' : $model->getImageUrl(),
        'aspectRatio' => '4:4',

    ]);
    ?>
    <br>
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Сохранить') : Yii::t('app', 'Сохранить'), [
                'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name' => 'action', 'value' => 'save'
            ]) . ' ';
        echo Html::submitButton(Yii::t('app', 'Редактировать характеристики'), [
            'class' => 'btn btn-info', 'name' => 'action', 'value' => 'chars'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
