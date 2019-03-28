<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model common\models\User */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grid">
    <div class="grid__item large--one-third push--large--one-third text-center">
        <div class="note form-success" id="ResetSuccess" style="display:none;">
            We've sent you an email with a link to update your password.
        </div>

        <div id="CustomerLoginForm" class="form-vertical">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <h1><?= $this->title ?></h1>

            <?= $form->field($model, 'mail')->textInput(); ?>

            <?= $form->field($model, 'password')->passwordInput(); ?>

            <?= $form->field($model, 'name')->textInput(); ?>

            <?= $form->field($model, 'address')->textInput(); ?>

            <?= $form->field($model, 'phone')->textInput(); ?>

            <p>
                <?= Html::submitButton('Зерегистрироваться', ['class' => 'btn btn--full']) ?>
            </p>

            <p><a href="<?= Yii::$app->urlHelper->to(['login']) ?>">Вход</a></p>

            <p><a href="<?= Yii::$app->urlHelper->to(['forgot-password']) ?>">Восстановить пароль</a></p>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
