<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\LoginForm */
/* @var $passwordResetForm \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use Yii;

$this->title = 'Авторизация';
?>

<div class="f-s_0 title-register without-crumbs">
    <div class="frame-title">
        <h1 class="title"><?= \Yii::t('app', 'Авторизация'); ?></h1>
    </div>
</div>
<div class="horizontal-form nice-checkbox" style="width:50%;float:left;">
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

    <?= $form->field($model, 'username', ['inputTemplate' => '{input}<span class="must">*</span>']); ?>

    <?= $form->field($model, 'password', ['inputTemplate' => '{input}<span class="must">*</span>'])->passwordInput(); ?>

    <div>
        <a href="<?= Yii::$app->urlHelper->to(['forgot-password']) ?>" class="d_l_3 isDrop">
            <?= \Yii::t('app', 'Напомнить пароль'); ?>
        </a>
    </div>
    
    <div class="frame-label">
        <?= Html::checkbox('LoginForm[rememberMe]', $model->rememberMe, ['id' => 'remember-me']); ?>
        <?= Html::label(Yii::t('app', 'Запомнить меня'), 'remember-me'); ?>
        <span class="title">&nbsp;</span>
        <div class="frame-form-field">
            <div>
                <span class="btn-form f_l m-r_20">
                    <?= Html::submitButton('<span class="text-el" style="color:#fff">' . \Yii::t('app', 'Войти') . '</span>',
                        ['style' => 'background: #34a4e7;', 'name' => 'login-button']) ?>
                </span>
            </div>
        </div>
    </div>
    <div class="drop-footer-style" style="width:315px; padding-right: 50px;">
            <div class="horizontal-form">
                <div class="frame-label">
                    <div class="frame-form-field">
                        <div class="help-block"><?= \Yii::t('app', 'Для новых покупателей'); ?>:
                        </div>
                        <a href="<?= Yii::$app->urlHelper->to(['register']) ?>"><?= \Yii::t('app', 'Регистрация'); ?></a>
                    </div>
                </div>
            </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<div class="social-login">Войти как пользователь: <br>
    <a href="<?= Yii::$app->urlHelper->to(['user/vk-auth']); ?>">
        <img src="https://s3.eu-central-1.amazonaws.com/umo4ka/401945557389.png">
    </a>
    <a href="<?= Yii::$app->urlHelper->to(['user/facebook-auth']); ?>">
        <img src="https://s3.eu-central-1.amazonaws.com/umo4ka/402107608125.png">
    </a>
</div>
