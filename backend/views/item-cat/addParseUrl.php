<?php

use common\models\Parse;
use yii\helpers\Html;
use unclead\multipleinput\MultipleInput;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Parse */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-cat-form">
    <div class="box box-info">
        <div class="box-header with-border">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

            echo $form->field($model, 'url')->textInput(['maxlength' => true]);

            ?>
            <br>
            <div class="form-group">
                <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Сохранить') : Yii::t('app', 'Сохранить'), [
                        'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name' => 'action', 'value' => 'save'
                    ]) . ' ';?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>