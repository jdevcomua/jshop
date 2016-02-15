<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-cat-form">

    <?php $form = ActiveForm::begin();
    echo "<div style=\"width: 100%; padding-left: 15px; margin-top: 20px;\">";
    foreach ($models as $index => $category) {
            /* @var $category common\models\ItemCat*/
            echo "<div style=\"width: 500px; float:left; padding-right: 50px;\">";
            echo $form->field($category, "[$index]title")->label($category->title);
            echo "</div>";

    }
    echo "</div>";
    echo "<div style=\"width: 100%; padding-left: 15px; float: right;\" class=\"form-group\">";
    echo Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'button']);
    echo "</div>";

    ActiveForm::end(); ?>

</div>
