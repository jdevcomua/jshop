<?php

use common\models\Characteristic;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Characteristic */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories array */
?>

<div class="characteristic-form">

    <?php $form = ActiveForm::begin();

    echo $form->field($model, 'category_id')->widget(Select2::classname(), [
        'data' => $categories,
        'options' => ['placeholder' => ''],
        'theme' => Select2::THEME_DEFAULT,
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    
    echo $form->field($model, 'title')->textInput(['maxlength' => true]);
    
    echo $form->field($model, 'type')->dropDownList(Characteristic::getTypesArray());
    ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Сохранить') : Yii::t('app', 'Сохранить'), [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
