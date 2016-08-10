<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <div class="f-s_0 without-crumbs">
        <div class="frame-title">
            <h1 class="title"><?= \Yii::t('app', 'Восстановление пароля'); ?></h1>
        </div>
    </div>
    <p><?php echo \Yii::t('app', 'Введите email. Ссылка на сброс пароля будет отправлена на указанный адрес.'); ?></p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

            <?= $form->field($model, 'mail')->input('text', ['style' => 'width:250px;'])->label('E-mail',
                ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

            <div class="btn-form">
                <?= Html::submitButton('<span class="text-el" style="color:#fff">' . \Yii::t('app', 'Отправить') . '</span>',
                    ['style' => 'background: #34a4e7;', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
