<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>
    <div style="width: 500px; float:left; padding-right: 50px;">
        <?= $form->field($model, 'user_id')->textInput(); ?>
    </div>

    <div style="width: 500px; float:left; padding-right: 50px;">
        <?= $form->field($model, 'timestamp')->textInput(); ?>
    </div>

    <div style="width: 500px; float:left; padding-right: 50px;">
        <?= $form->field($model, 'address')->textInput(); ?>
    </div>

    <div style="width: 500px; float:left; padding-right: 50px;">
        <?= $form->field($model, 'name')->textInput(); ?>
    </div>

    <div style="width: 500px; float:left; padding-right: 50px;">
        <?= $form->field($model, 'phone')->textInput(); ?>
    </div>

    <div style="width: 500px; float:left; padding-right: 50px;">
        <?= $form->field($model, 'delivery')->textInput(); ?>
    </div>

    <div style="width: 500px; float:left; padding-right: 50px;">
        <?= $form->field($model, 'mail')->textInput(); ?>
    </div>

    <div style="width: 500px; float:left; padding-right: 50px;">
        <?= $form->field($model, 'payment')->textInput(); ?>
    </div>

    <div style="width: 500px; float:left; padding-right: 50px;">
        <?= $form->field($model, 'sum')->textInput(['type' => 'number']); ?>
    </div>

    <div style="width: 500px; float:left; padding-right: 50px;">
        <? $form->field($model, 'order_status')->dropDownList(['Новый' => 'Новый', 'Отправлен' => 'Отправлен',
            'Доставлен' => 'Доставлен']); ?>
    </div>

    <div style="width: 500px; float:left; padding-right: 50px;">
        <?= $form->field($model, 'payment_status')->dropDownList(['Оплачен' => 'Оплачен', 'Не оплачен' => 'Не оплачен']); ?>
    </div>

    <div class="form-group">
        <div style="width: 100%; float:left; padding-right: 50px;">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
