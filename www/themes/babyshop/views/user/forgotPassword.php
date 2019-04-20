<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \www\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-container col1-layout wow bounceInUp animated animated" style="visibility: visible;">

    <div class="main">
        <div class="account-login container">
            <br>
            <?= \common\widgets\Alert::widget(['options' => ['class'=>'visible']]) ?>

            <!--page-title-->
            <fieldset class="col2-set">
                <div class="col-1 new-users">
                    <strong>Forgot password</strong>
                    <div class="content">
                        <p>Enter email. Link to reset the password will be sent to the specified address.</p>
                    </div>
                </div>
                <div class="col-2 registered-users">
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                    <div class="content">
                        <ul class="form-list">
                            <li>
                                <label for="email">Email Address<em class="required">*</em></label>
                                <div class="input-box">
                                    <input type="text" name="PasswordResetRequestForm[mail]" value="" id="passwordresetrequestform-mail" class="input-text required-entry validate-email" title="Email Address">
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
