<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CharacteristicsForm*/
/* @var $item common\models\Item */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="item-form">
    <?php $form = ActiveForm::begin();
    /* @var $category common\models\ItemCat */
    $category = $item->getCategory()->one();
    $characteristics = $category->getCharacteristics()->all();
    foreach($characteristics as $key => $value){
        /* @var $value common\models\Characteristic */?>
        <?= $form->field($model, 'inputs['.$key.'][0]')->hiddenInput(['value' => $value->id])->label("") ?>
        <?= $form->field($model, 'inputs['.$key.'][1]')->hiddenInput(['value' => $item->id])->label("") ?>
        <?= $form->field($model, 'inputs['.$key.'][2]')->textInput()->label($value->title) ?>
        <?php
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
