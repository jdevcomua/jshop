<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Сброс пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Введите новый пароль:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true, 'style' => 'width:250px;'])->label('Новый пароль',
                    ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

                <div class="btn-form">
                    <?= Html::submitButton('<span class="text-el" style="color:#fff">' . \Yii::t('app', 'Сохранить') . '</span>',
                        ['style' => 'background: #34a4e7;']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
