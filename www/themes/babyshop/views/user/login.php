<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $model common\models\LoginForm */

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-container col1-layout wow bounceInUp animated animated" style="visibility: visible;">

    <div class="main">
        <div class="account-login container">
            <!--page-title-->
            <br>
            <?= \common\widgets\Alert::widget(['options' => ['class'=>'visible']]) ?>

                <fieldset class="col2-set">
                    <div class="col-1 new-users">
                        <strong>Sign in from social network</strong>
                        <div class="content">
                            <div class="buttons-set">
<!--<form action="-->--><?////= $loginUrl ?><!--<!--">-->
<!--                                    <button type="submit" title="Create an Account" class="button facebook-account"><span><span>Join with Facebook</span></span></button>-->
<!--                                </form>-->
                                <a href="<?= $loginUrl?>">Facebook</a>
                            </div>
                        </div>
                        <br>
                        <strong>New Customers</strong>
                        <div class="content">
                            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                            <div class="buttons-set"><form action="<?= Url::toRoute('user/register') ?>">
                                <button type="submit" title="Create an Account" class="button create-account"><span><span>Create an Account</span></span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 registered-users">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <strong>Registered Customers</strong>
                        <div class="content">

                            <p>If you have an account with us, please log in.</p>
                            <ul class="form-list">
                                <li>
                                    <label for="email">Email Address<em class="required">*</em></label>
                                    <div class="input-box">
                                        <input type="text" name="LoginForm[username]" value="" id="loginform-username" class="input-text required-entry validate-email" title="Email Address">
                                    </div>
                                </li>
                                <li>
                                    <label for="pass">Password<em class="required">*</em></label>
                                    <div class="input-box">
                                        <input type="password" name="LoginForm[password]" class="input-text required-entry validate-password" id="loginform-password" title="Password">
                                    </div>
                                </li>
                            </ul>

                            <p class="required">* Required Fields</p>

                            <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'input-checkbox'])->label('Запомнить меня'); ?>


                            <div class="buttons-set">

                                <?= Html::submitButton('Login', ['class' => 'button login']) ?>


                                <a href="<?= Yii::$app->urlHelper->to(['forgot-password']) ?>" class="forgot-word">Forgot Your Password?</a>
                            </div> <!--buttons-set-->
                        </div> <!--content-->
                        <?php ActiveForm::end(); ?>
                    </div> <!--col-2 registered-users-->
                </fieldset> <!--col2-set-->


        </div> <!--account-login-->

    </div><!--main-container-->

</div> <!--col1-layout-->



