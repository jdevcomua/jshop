<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \www\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Сброс пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-container col1-layout wow bounceInUp animated animated" style="visibility: visible;">

    <div class="main">
        <div class="account-login container">
            <!--page-title-->
            <fieldset class="col2-set">
                <div class="col-1 new-users">
                    <strong>Reset pssword</strong>
                </div>
                <div class="col-2 registered-users">
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                    <div class="content">
                        <ul class="form-list">
                            <li>
                                <label for="email">New Password<em class="required">*</em></label>
                                <div class="input-box">
                                    <input type="password" name="ResetPasswordForm[password]" value="" id="resetpasswordform-password" class="input-text required-entry validate-password" title="Email Address">
                                </div>
                            </li>
                        </ul>

                        <p class="required">* Required Fields</p>
                        <div class="buttons-set">

                            <?= Html::submitButton('Forgot', ['class' => 'button login']) ?>


                            <a href="<?= Yii::$app->urlHelper->to(['forgot-password']) ?>" class="forgot-word">Forgot Your Password?</a>
                        </div> <!--buttons-set-->
                    </div> <!--content-->
                    <?php ActiveForm::end(); ?>
                </div> <!--col-2 registered-users-->
            </fieldset> <!--col2-set-->


        </div> <!--account-login-->

    </div><!--main-container-->

</div> <!--col1-layout-->
