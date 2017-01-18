<?php

use common\models\WishList;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model WishList */

?>
<div class="jspContainer" style="width: 500px; height: 189px;">
    <div class="jspPane" style="padding: 0; top: 0; width: 500px;">
        <div class="inside-padd">
            <?php $form = ActiveForm::begin(['action' => Yii::$app->urlHelper->to(['profile#wish_list'])]); ?>
            <div class="horizontal-form ">

                <div class="frame-label">
                    <?= $form->field($model, 'title')->textInput(); ?>
                </div>
                <?= $form->field($model, 'id')->hiddenInput()->label(''); ?>
                <div class="frame-label">
                    <label></label>
                    <?= Html::submitButton(Yii::t('app', 'Создать новый список'), ['class' => 'blue-button']) ?>
                </div>

            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>