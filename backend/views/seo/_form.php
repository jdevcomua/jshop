<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Seo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seo-form">
    <div style="width: 100%;">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'keywords')->textInput(['maxlength' => true])->label(Yii::t('app','Keywords (comma separated)')) ?>

        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'new_url')->textInput(['maxlength' => true])->label(Yii::t('app','New URL(Фраза которая находиться после номера элемента)')) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
