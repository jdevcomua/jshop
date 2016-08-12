<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="orders-input">
        <?= $form->field($model, 'user_id')->textInput(); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'timestamp')->textInput(); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'address')->textInput(); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'name')->textInput(); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'phone')->textInput(); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'delivery')->textInput(); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'mail')->textInput(); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'payment')->textInput(); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'sum')->textInput(['type' => 'number']); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'order_status')->dropDownList(['Новый' => 'Новый', 'Отправлен' => 'Отправлен',
            'Доставлен' => 'Доставлен']); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'payment_status')->dropDownList(['Оплачен' => 'Оплачен', 'Не оплачен' => 'Не оплачен']); ?>
    </div>

    <div class="clear"></div>

    <?= $form->field($model, 'comment')->textarea(['rows' => 4]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
