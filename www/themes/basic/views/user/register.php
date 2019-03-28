<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\User */

use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
?>

<div class="f-s_0 title-register without-crumbs">
    <div class="frame-title">
        <h1 class="title"><?= \Yii::t('app', 'Регистрация'); ?></h1>
    </div>
</div>
<div class="frame-register">
    <?php $form = ActiveForm::begin(); ?>
    <div class="horizontal-form">
        
        <?= $form->field($model, 'username', ['inputTemplate' => '{input}<span class="must">*</span>']); ?>

        <?= $form->field($model, 'password', ['inputTemplate' => '{input}<span class="must">*</span>'])->passwordInput(); ?>

        <?= $form->field($model, 'mail', ['inputTemplate' => '{input}<span class="must">*</span>']); ?>

        <?= $form->field($model, 'name'); ?>

        <?= $form->field($model, 'surname'); ?>

        <?= $form->field($model, 'phone'); ?>

        <?= $form->field($model, 'address'); ?>

        <div class="frame-label">
            <span class="title">&nbsp;</span>
            <div class="frame-form-field">
                <div class="btn-form m-b_15">
                    <?= Html::submitButton('<span class="text-el" style="color:#fff">' . \Yii::t('app', 'Зарегистрироваться') . '</span>',
                        ['style' => 'background: #34a4e7;', 'name' => 'login-button']) ?>
                </div>
                <p class="help-block"><?= \Yii::t('app', 'Я уже зарегистрирован'); ?></p>
                <ul class="items items-register-add-ref">
                    <li>
                        <a href="<?= Yii::$app->urlHelper->to(['login']); ?>" type="button">
                            <span class="text-el d_l_1"><?= \Yii::t('app', 'Войти'); ?></span>
                        </a>
                    </li>
                    <li>
                        <span class="divider">|</span>
                        <button type="button">
                            <span class="text-el d_l_1"><?= \Yii::t('app', 'Напомнить пароль'); ?></span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<div class="social-login">Войти как пользователь: <br>
    <a href="<?php echo Yii::$app->urlHelper->to(['user/vk-auth']); ?>">
        <img src="https://s3.eu-central-1.amazonaws.com/umo4ka/401945557389.png">
    </a>
    <a href="<?php echo Yii::$app->urlHelper->to(['user/facebook-auth']); ?>">
        <img src="https://s3.eu-central-1.amazonaws.com/umo4ka/402107608125.png">
    </a>
</div>
