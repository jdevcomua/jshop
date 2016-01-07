<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin();
    echo "<div style=\"width: 500px; float:left; padding-right: 50px;\">";
    echo $form->field($model, 'user_id')->textInput();
    echo "</div>";

    echo "<div style=\"width: 500px; float:left; padding-right: 50px;\">";
    echo $form->field($model, 'timestamp')->textInput();
    echo "</div>";

    echo "<div style=\"width: 500px; float:left; padding-right: 50px;\">";
    echo $form->field($model, 'address')->textInput();
    echo "</div>";

    echo "<div style=\"width: 500px; float:left; padding-right: 50px;\">";
    echo $form->field($model, 'name')->textInput();
    echo "</div>";

    echo "<div style=\"width: 500px; float:left; padding-right: 50px;\">";
    echo $form->field($model, 'phone')->textInput();
    echo "</div>";

    echo "<div style=\"width: 500px; float:left; padding-right: 50px;\">";
    echo $form->field($model, 'delivery')->textInput();
    echo "</div>";

    echo "<div style=\"width: 500px; float:left; padding-right: 50px;\">";
    echo $form->field($model, 'mail')->textInput();
    echo "</div>";

    echo "<div style=\"width: 500px; float:left; padding-right: 50px;\">";
    echo $form->field($model, 'payment')->textInput();
    echo "</div>";

    echo "<div style=\"width: 500px; float:left; padding-right: 50px;\">";
    echo $form->field($model, 'sum')->textInput(['type' => 'number']);
    echo "</div>";

    echo "<div style=\"width: 500px; float:left; padding-right: 50px;\">";
    echo $form->field($model, 'order_status')->dropDownList(['Новый' => 'Новый', 'Отправлен' => 'Отправлен', 'Доставлен' => 'Доставлен']);
    echo "</div>";

    echo "<div style=\"width: 500px; float:left; padding-right: 50px;\">";
    echo $form->field($model, 'payment_status')->dropDownList(['Оплачен' => 'Оплачен', 'Не оплачен' => 'Не оплачен']);
    echo "</div>";

    ?>

    <div class="form-group">
        <?php
        echo "<div style=\"width: 100%; float:left; padding-right: 50px;\">";
        echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
        echo "</div>";
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
