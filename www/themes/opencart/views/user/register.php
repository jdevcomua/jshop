<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\User */

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

?>
<div id="content" class="col-sm-12">
    <h1><?= Yii::t('app', 'Регистрация');?></h1>
    <p><?= Yii::t('app', 'Я уже зарегистрирован');?> <a href="<?= Url::to(['user/login']) ?>"><?= Yii::t('app', 'Войти');?></a>.</p>
    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-10">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
        ],
    ]); ?>
        <fieldset id="account">
            <legend><?= Yii::t('app', 'Ваши персональные данные');?></legend>
            <?= $form->field($model, 'username'); ?>
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'От 4 до 25 символов']); ?>
            <?= $form->field($model, 'email'); ?>
            <?= $form->field($model, 'name'); ?>
            <?= $form->field($model, 'surname'); ?>
            <?= $form->field($model, 'phone'); ?>
            <?= $form->field($model, 'address'); ?>
        </fieldset>
        <div class="buttons">
            <div class="pull-right">
                <input type="submit" value="Continue" class="btn btn-primary">
            </div>
        </div>
    <?php ActiveForm::end();?>
</div>
