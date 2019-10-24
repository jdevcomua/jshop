<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin();

    echo $form->field($model, 'name')->textInput(['maxlength' => true]);

    echo $form->field($model, 'surname')->textInput(['maxlength' => true]);

    echo $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']);

    echo $form->field($model, 'city')->textInput(['maxlength' => true]);

    echo $form->field($model, 'address')->textInput(['maxlength' => true]);

    echo  $form->field($model, 'phone')->widget(MaskedInput::className(), ['class' => 'input-box input-text',
                                    'mask' => '+38 (099) 999-99-99',
                                    'options' => [
                                        'class' => 'input-box input-text',
                                        'id' => 'phone2',
                                    ],
                                    'clientOptions' => [
                                        'clearIncomplete' => true
                                    ]
                                ])->label(Yii::t('app', 'Phone number'));

    echo $form->field($model, 'fb_id')->textInput(['maxlength' => true]);

    echo $form->field($model, 'password')->textInput(['maxlength' => true, 'required'=> true]);

    echo $form->field($model, 'confirm_password')->textInput(['maxlength' => true, 'required'=> true]);
    ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Сохранить') : Yii::t('app', 'Сохранить'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
