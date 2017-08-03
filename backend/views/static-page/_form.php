<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zxbodya\yii2\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\StaticPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="static-page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(TinyMce::className(), [
        'options' => ['rows' => 10],
        'language' => 'ru',
        //'compressorRoute' => 'compressor/tinyMceCompressor',
        /*'fileManager' => [
            'class' => TinyMceElFinder::className(),
            'connectorRoute' => 'el-finder/connector',
        ],*/
        //'spellcheckerUrl' => '//speller.yandex.net/services/tinyspell',
        'settings' => [
            'height' => '500',
            'convert_urls' => false,
        ],
    ]); ?>
    
    <?= $form->field($model, 'route')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
