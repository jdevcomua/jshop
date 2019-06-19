<?php

use common\models\Parse;
use yii\helpers\Html;
use unclead\multipleinput\MultipleInput;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCat */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories array */
/* @var $categories array */
?>

<div class="item-cat-form">

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