<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCat */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories array */
?>

<div class="item-cat-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

    echo $form->field($model, 'title')->textInput(['maxlength' => true]);
    
    echo $form->field($model, 'active')->checkbox();

    echo $form->field($model, 'parent_id')->widget(Select2::classname(), [
        'data' => $categories,
        'options' => ['placeholder' => ''],
        'theme' => Select2::THEME_DEFAULT,
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    $images = [];
    if (!$model->isNewRecord && !empty($model->image)) {
        $images[] = Html::img($model->getImageUrl(), ['width' => '120px']);
    }
    echo $form->field($model, 'imageFile')->widget(
        \backend\widget\CropWidget\CropWidget::className(), [
        'uploadUrl' => \yii\helpers\Url::toRoute('/item/uploadPhoto'),
        'noPhotoImage' => ($model->isNewRecord) ? '' : $model->getOneImageUrl(),
        'aspectRatio' => '4:4',

    ]);
    ?>
    <br>
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Сохранить') : Yii::t('app', 'Сохранить'), [
                'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name' => 'action', 'value' => 'save'
            ]) . ' ';
        echo Html::submitButton(Yii::t('app', 'Редактировать характеристики'), [
            'class' => 'btn btn-info', 'name' => 'action', 'value' => 'chars'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
