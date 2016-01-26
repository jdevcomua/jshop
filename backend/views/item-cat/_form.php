<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-cat-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

    echo $form->field($model, 'title')->textInput(['maxlength' => true]);

    echo $form->field($model, 'parent_id')->widget(Select2::classname(), [
        'data' => $categories,
        'options' => ['placeholder' => 'Select a parent ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    $images = [];
    if (!$model->isNewRecord && !empty($model->image)) {
        $images[] = Html::img($model->getImageUrl(), ['width' => '120px']);
    }
    echo FileInput::widget([
        'model' => $model,
        'attribute' => 'imageFile',
        'options'=>[
            'multiple' => false,
        ],
        'pluginOptions' => [
            'initialPreview' => $images,
            'initialPreviewConfig' => [
                'width' => '120px'
            ],
            'showUpload' => false,
            'overwriteInitial' => false,
            'maxFileCount' => 1
        ]
    ]);
    ?>
<br>
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Сохранить') : Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
