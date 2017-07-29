<?php

use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories array */
?>

<div class="item-form">
    <div style="width: 100%;">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                    'data' => $categories,
                    'options' => ['placeholder' => ''],
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>
            <div class="col-md-6" style="padding-top: 30px">
                <?= $form->field($model, 'active')->checkbox() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-6">
                <?php echo $form->field($model, 'cost')->textInput(); ?>
            </div>
        </div>

        <?= $form->field($model, 'description')->widget(TinyMce::className(), [
            'options' => ['rows' => 10],
            'language' => 'ru',
            'clientOptions' => [
                'plugins' => [
                    "advlist autolink lists link charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            ]
        ]); ?>

        <?php $images = [];
        if (!$model->isNewRecord) {
            foreach ($model->getImageUrl() as $url) {
                $images[] = Html::img($url, ['width' => '120px']);
            }
        }
        echo $form->field($model, 'imageFiles[]')->widget(FileInput::classname(), [
            'options' => [
                'multiple' => true,
            ],
            'pluginOptions' => [
                'initialPreview' => $images,
                'initialPreviewConfig' => [
                    'width' => '120px'
                ],
                'showUpload' => false,
                'overwriteInitial' => false,
                'maxFileCount' => 3
            ]
        ]); ?>

        <div class="form-group"><br>
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), [
                'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                'name' => 'action',
                'value' => 'save'
            ]); ?>
            <?= Html::submitButton(Yii::t('app', 'Редактировать характеристики'), [
                'class' => 'btn btn-info',
                'name' => 'action',
                'value' => 'characteristics'
            ]); ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>