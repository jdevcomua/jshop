<?php

use common\models\Seo;
use yii\helpers\Html;
use unclead\multipleinput\TabularInput;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCat */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories array */
/* @var $categories array */
/* @var $seo Seo */
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">
            <?= Html::encode($this->title);?>
        </h3>
    </div>
    <div class="box-body">
        <div class="item-cat-form">

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

            <?= $form->field($model, 'active')->checkbox(); ?>

            <?= $form->field($model, 'adult')->checkbox(); ?>

            <?= $form->field($model, 'parent_id')->widget(Select2::classname(), [
                'data' => $categories,
                'options' => ['placeholder' => ''],
                'theme' => Select2::THEME_DEFAULT,
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'parent_id')->widget(Select2::class, [
                'data' => $categories,
                'options' => ['placeholder' => ''],
                'theme' => Select2::THEME_DEFAULT,
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

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
        </div>
    </div>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">
            URl (Для парсинга из МЕТРО)
        </h3>
    </div>
    <div class="box-body">
        <?=  TabularInput::widget([
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
                    'type'  => \unclead\multipleinput\MultipleInputColumn::TYPE_TEXT_INPUT,
                ],
            ]
        ]); ?>
    </div>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">
            Seo
        </h3>
    </div>
    <div class="box-body">
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
                <?= $form->field($seo, 'keywords')->textInput(['maxlength' => true])->label(Yii::t('app','Keywords (comma separated)')) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($seo, 'h1')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($seo, 'new_url')->textInput(['maxlength' => true])->label(Yii::t('app','New URL(Фраза которая находиться после номера элемента)')) ?>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
</div>

<div class="box box-info">
    <div class="box-body">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Сохранить') : Yii::t('app', 'Сохранить'), [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name' => 'action', 'value' => 'save'
        ]) . ' '; ?>
        <?= Html::submitButton(Yii::t('app', 'Редактировать характеристики'), [
            'class' => 'btn btn-info', 'name' => 'action', 'value' => 'chars'
        ]) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>