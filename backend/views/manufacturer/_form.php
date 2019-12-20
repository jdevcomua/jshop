<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Manufacturer */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">
            <?= Html::encode($this->title);?>
        </h3>
    </div>
    <div class="box-body">
        <div class="manufacturer-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'metro_name')->textInput(['maxlength' => true, 'readonly' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

