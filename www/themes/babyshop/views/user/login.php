<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model common\models\LoginForm */

$this->title = 'Вход';
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

            <?= $form->field($model, 'username')->textInput(); ?>

            <?= $form->field($model, 'password')->passwordInput(); ?>

            <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'input-checkbox'])->label('Запомнить меня'); ?>

            <p>
                <?= Html::submitButton('Войти', ['class' => 'btn btn--full']) ?>
            </p>

            <p><a href="<?= Yii::$app->urlHelper->to(['forgot-password']) ?>">Восстановить пароль</a></p>

            <p><a href="<?= Yii::$app->urlHelper->to(['register']) ?>">Регистрация</a></p>

            <?php ActiveForm::end(); ?>
        </div>




        <div id="RecoverPasswordForm" style="display: none;">

            <h2>Reset your password</h2>
            <p>We will send you an email to reset your password.</p>

            <div class="form-vertical">
                <form method="post" action="https://baby-shop-6.myshopify.com/account/recover" accept-charset="UTF-8">
                    <input type="hidden" value="recover_customer_password" name="form_type"><input type="hidden"
                                                                                                   name="utf8"
                                                                                                   value="✓">


                    <label for="RecoverEmail" class="hidden-label">Email</label>
                    <input type="email" value="" name="email" id="RecoverEmail" class="input-full" placeholder="Email"
                           autocorrect="off" autocapitalize="off">

                    <p>
                        <input type="submit" class="btn btn--full" value="Submit">
                    </p>
                    <button type="button" id="HideRecoverPasswordLink" class="text-link">Cancel</button>
                </form>
            </div>

        </div>


    </div>

</div>
