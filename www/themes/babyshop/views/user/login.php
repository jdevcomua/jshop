<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $loginUrl string */
/* @var $model common\models\LoginForm */

$this->title = Yii::t('app', 'Login');
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
                        <strong><?=Yii::t('app', 'Sign in from social network')?></strong>
                        <div class="content">
                            <div class="buttons-set">
                                <button type="submit" title="Create an Account" class="button facebook-account" onclick="location.replace('<?=$loginUrl?>');"><span><span><?=Yii::t('app', 'Join with Facebook')?></span></span></button>
<!--                                <a title="Login with Facebook" class="facebook-account" href="--><?//= $loginUrl?><!--"><span><span>Join with Facebook</span></span></a>-->
                            </div>
                        </div>
                        <br>
                        <strong><?=Yii::t('app', 'New Customers')?></strong>
                        <div class="content">
                            <p><?=Yii::t('app', 'By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.')?></p>
                            <div class="buttons-set"><form action="<?= Url::toRoute('user/register') ?>">
                                <button type="submit" title="Create an Account" class="button create-account"><span><span><?=Yii::t('app', 'Create an Account')?></span></span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 registered-users">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <strong><?=Yii::t('app', 'Registered Customers')?></strong>
                        <div class="content">

                            <p><?=Yii::t('app', 'If you have an account with us, please log in.')?></p>
                            <ul class="form-list">
                                <li>
                                    <?= $form->field($model, 'email')->textInput(['class' => 'input-box input-text required-entry'])->label(Yii::t('app/model','Адрес электронной почты').'<span class="required">*</span>')?>
                                </li>
                                <li>
                                    <?= $form->field($model, 'password')->passwordInput(['class' => 'input-box input-text required-entry'])->label(Yii::t('app/model','Пароль').'<span class="required">*</span>') ?>
                                </li>
                            </ul>

                            <p class="required">*<?=Yii::t('app', 'Required Fields')?> </p>

                            <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'input-checkbox','value'=>false])->label(Yii::t('app', 'Remember me')); ?>


                            <div class="buttons-set">

                                <?= Html::submitButton('Login', ['class' => 'button login']) ?>


                                <a href="<?= Yii::$app->urlHelper->to(['forgot-password']) ?>" class="forgot-word"><?=Yii::t('app', 'Forgot Your Password?')?></a>
                            </div> <!--buttons-set-->
                        </div> <!--content-->
                        <?php ActiveForm::end(); ?>
                    </div> <!--col-2 registered-users-->
                </fieldset> <!--col2-set-->


        </div> <!--account-login-->

    </div><!--main-container-->

</div> <!--col1-layout-->



