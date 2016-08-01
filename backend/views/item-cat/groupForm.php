<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $models \common\models\ItemCat[] */
?>

<div class="item-cat-form">

    <?php $form = ActiveForm::begin(); ?>
    <div style="width: 100%; padding-left: 15px; margin-top: 20px;">
        <?php /* @var $category common\models\ItemCat */
        foreach ($models as $index => $category) { ?>
            <div style="width: 500px; float:left; padding-right: 50px;">
                <?= $form->field($category, "[$index]title")->label($category->title); ?>
            </div>

        <?php } ?>
    </div>
    <div style="width: 100%; padding-left: 15px; float: right;" class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'button']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
