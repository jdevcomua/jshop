<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('app', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="main-container col1-layout wow bounceInUp animated animated" style="visibility: visible;">

    <div class="main">
        <div class="account-login container">
            <!--page-title-->

            <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>
            <fieldset class="col2-set">
                <div class="col-1 new-users">
                    <strong><?=Yii::t('app', 'Register and unlock the opportunity')?>: </strong>
                    <div class="content">

                        <p><?=Yii::t('app', 'Leave feedback')?></p>
                        <p><?=Yii::t('app', 'Use wish list')?></p>

                    </div>
                </div>
                <div class="col-2 registered-users">
                    <strong><?=Yii::t('app', 'Registered Customers')?></strong>
                    <div class="content">

                        <p><?=Yii::t('app', 'If you have an account with us, please log in.')?></p>
                        <ul class="form-list">
                            <li>
                                <label for="email"><?=Yii::t('app', 'Email Address')?><em class="required">*</em></label>
                                <div class="input-box">
                                    <input type="text" name="User[mail]" value="" id="user-mail" class="input-text required-entry validate-email" title="Email Address">
                                </div>
                            </li>
                            <li>
                                <label for="pass"><?=Yii::t('app', 'Password')?><em class="required">*</em></label>
                                <div class="input-box">
                                    <input type="password" name="User[password]" class="input-text required-entry validate-password" id="user-password" title="Password">
                                </div>
                            </li>
                            <li>
                                <label for="email"><?=Yii::t('app', 'User Name')?></label>
                                <div class="input-box">
                                    <input type="text" name="User[name]" value="" id="user-name" class="input-text" title="Email Address">
                                </div>
                            </li>
                            <li>
                                <label for="email"><?=Yii::t('app', 'Address')?></label>
                                <div class="input-box">
                                    <input type="text" name="User[address]" value="" id="user-address" class="input-text" title="Email Address">
                                </div>
                            </li>
                            <li>
                                <label for="email"><?=Yii::t('app', 'Phone number')?></label>
                                <div class="input-box">
                                    <input type="text" name="User[phone]" value="" id="user-phone" class="input-text" title="Email Address">
                                </div>
                            </li>
                        </ul>

                        <p class="required">* <?=Yii::t('app', 'Required Fields')?></p>

                        <div class="buttons-set">

                            <?= Html::submitButton('Register', ['class' => 'button login']) ?>

                           <a href="<?= Yii::$app->urlHelper->to(['forgot-password']) ?>"  class="forgot-word"><?=Yii::t('app', 'Forgot Your Password?')?></a>
                        </div> <!--buttons-set-->
                    </div> <!--content-->
                </div>
            </fieldset> <!--col2-set-->
            <?php ActiveForm::end(); ?>

        </div> <!--account-login-->

    </div><!--main-container-->

</div> <!--col1-layout-->
