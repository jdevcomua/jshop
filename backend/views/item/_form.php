<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="item-form">
    <div style="width: 100%;">
    <div style="width: 600px; float:left;">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

        echo $form->field($model, 'category_id')->dropDownList(\common\models\ItemCat::getCategorys_Id_Title());

        echo $form->field($model, 'title')->textInput(['maxlength' => true]);

        echo $form->field($model, 'cost')->textInput();

        echo $form->field($model, 'imageFile')->fileInput();?>

        <div class="form-group">
            <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Сохранить') : Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
</div>

        <?php if(!$model->isNewRecord){?>
    <div style="width: 500px; float:left; padding-left: 50px;">
        <img width="300px" src="<?php echo $model->getImageUrl(); ?>">
    </div>
        <?php }?>
    </div>


</div>
