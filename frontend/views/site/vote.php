<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $vote common\models\Vote */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="item-cat-form">

    <?php $form = ActiveForm::begin();

    echo $form->field($vote, 'text')->textarea()->label("");

    echo $form->field($vote, 'item_id')->hiddenInput(['value'=>$model->id])->label("");

    echo $form->field($vote, 'user_id')->hiddenInput()->label("") ?>

    <div class="form-group">
        <?php echo Html::submitButton($vote->isNewRecord ? Yii::t('app', 'Сохранить') : Yii::t('app', 'Сохранить'), ['class' => 'btn-search' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>