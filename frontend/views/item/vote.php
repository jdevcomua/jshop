<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $vote common\models\Vote */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="item-cat-form">

    <?php $form = ActiveForm::begin();?>

    <input name="Vote[rating]" type="range" min="0" max="5" value="0" step="1" id="backing4">
    <div class="rateit" data-rateit-backingfld="#backing4"></div>
    <script src="/rateit/jquery.rateit.js" type="text/javascript"></script>

    <?php
    echo $form->field($vote, 'text')->textarea()->label(""); ?>

    <div class="form-group">
        <?php echo Html::submitButton('<span class="text-el">' . Yii::t('app', 'Отправить') . '</span>>', ['class' => 'btn-search', 'style' => 'width: 110px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>