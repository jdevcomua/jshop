<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="item-form">
    <div style="width: 100%;">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

        echo $form->field($model, 'category_id')->dropDownList($categories, ['style' => 'width:48%;']);?>

        <div style="float: left;width:48%; margin-right: 4%;">
            <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]);?>
        </div>

        <?php echo $form->field($model, 'cost')->textInput(['style' => 'width:48%;']);?>

        <?php $images = [];
        if (!$model->isNewRecord) {
            foreach ($model->getImageUrl() as $url) {
                $images[] = Html::img($url, ['width' => '120px']);
            }
        }
        echo FileInput::widget([
            'model' => $model,
            'attribute' => 'imageFiles[]',
            'options'=>[
                'multiple' => true,
            ],
            'pluginOptions' => [
                'initialPreview' => $images,
                'initialPreviewConfig' => [
                    'width' => '120px'
                ],
                'showUpload' => false,
                'overwriteInitial' => false,
                'maxFileCount' => 3
            ]
        ]);
        ?>

        <div class="form-group"><br>
            <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Сохранить') : Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>