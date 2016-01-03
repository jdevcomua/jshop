<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin();

    echo $form->field($model, 'user_id')->textInput();

    echo $form->field($model, 'timestamp')->textInput();

    echo $form->field($model, 'address')->textInput(['maxlength' => true]);

    echo $form->field($model, 'name')->textInput(['maxlength' => true]);

    echo $form->field($model, 'phone')->textInput(['maxlength' => true]);

    echo $form->field($model, 'delivery')->textInput(['maxlength' => true]);

    echo $form->field($model, 'mail')->textInput(['maxlength' => true]);

    echo $form->field($model, 'payment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
