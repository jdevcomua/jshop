<?php

use common\models\Orders;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="orders-input">
        <?= $form->field($model, 'name')->textInput(); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'phone')->textInput(); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'address')->textInput(); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'sum')->textInput(['type' => 'number']); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'order_status')->dropDownList(Orders::getStatusTitles()); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'payment_status')->dropDownList(Orders::getPaymentStatusTitles()); ?>
    </div>

    <div class="orders-input">
        <?= $form->field($model, 'email')->textInput(); ?>
    </div>

    <div class="clear"></div>

    <?= $form->field($model, 'comment')->textarea(['rows' => 4]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
