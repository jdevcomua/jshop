<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \yii\widgets\MaskedInput;

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
                                <?= $form->field($model, 'email')->textInput(['class' => 'input-box input-text required-entry'])->label(Yii::t('app/model','Адрес электронной почты').'<em class="required">*</em>')?>
                            </li>
                            <li>
                                <?= $form->field($model, 'password')->passwordInput(['class' => 'input-box input-text required-entry'])->label(Yii::t('app', 'Password').'<em class="required">*</em>')?>
                            </li>
                            <li>
                                <?= $form->field($model, 'name')->textInput(['class' => 'input-box input-text'])->label(Yii::t('app', 'User Name'))?>
                            </li>
                            <li>
                                <?= $form->field($model, 'address')->textInput(['class' => 'input-box input-text'])->label(Yii::t('app', 'Address'))?>
                            </li>
                            <li>
                                <?= $form->field($model, 'phone')->widget(MaskedInput::className(), ['class' => 'input-box input-text',
                                    'mask' => '+38 (099) 999-99-99',
                                    'options' => [
                                        'class' => 'input-box input-text',
                                        'id' => 'phone2',
                                        'placeholder' => Yii::t('app', 'Phone number')
                                    ],
                                    'clientOptions' => [
                                        'clearIncomplete' => true
                                    ]
                                ])->label(Yii::t('app', 'Phone number')) ?>
                            </li>
                        </ul>

                        <p class="required">* <?=Yii::t('app', 'Required Fields')?></p>

                        <div class="buttons-set">

                            <?= Html::submitButton(Yii::t('app', 'Register'), ['class' => 'button login']) ?>

                           <a href="<?= Yii::$app->urlHelper->to(['forgot-password']) ?>"  class="forgot-word"><?=Yii::t('app', 'Forgot Your Password?')?></a>
                        </div> <!--buttons-set-->
                    </div> <!--content-->
                </div>
            </fieldset> <!--col2-set-->
            <?php ActiveForm::end(); ?>

        </div> <!--account-login-->

    </div><!--main-container-->

</div> <!--col1-layout-->
