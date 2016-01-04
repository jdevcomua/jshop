<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\User */

use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<?php echo $this->render('../layouts/menu', ['allCategories' => $allCategories]); ?>

<div class="content">
    <br>
    <div class="frame-inside page-product">
        <div class="container">
            <div class="f-s_0 title-register without-crumbs">
                <div class="frame-title">
                    <h1 class="title"><?php echo \Yii::t('app', 'Регистрация'); ?></h1>
                </div>
            </div>
            <div class="frame-register">
                <?php $form = ActiveForm::begin(); ?>
                <div class="horizontal-form">
                    <?php echo $form->field($model, 'username')->input('text', ['style' => 'width:250px;'])->label(null, ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

                    <?php echo $form->field($model, 'password')->passwordInput(['style' => 'width:250px;'])->label(null, ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

                    <?php echo $form->field($model, 'mail')->input('text', ['style' => 'width:250px;'])->label(null, ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

                    <?php echo $form->field($model, 'name')->input('text', ['style' => 'width:250px;'])->label(null, ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

                    <?php echo $form->field($model, 'surname')->input('text', ['style' => 'width:250px;'])->label(null, ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

                    <?php echo $form->field($model, 'phone')->input('text', ['style' => 'width:250px;'])->label(null, ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

                    <?php echo $form->field($model, 'address')->input('text', ['style' => 'width:250px;'])->label(null, ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

                    <div class="frame-label">
                        <span class="title">&nbsp;</span>
                        <div class="frame-form-field">
                            <div class="btn-form m-b_15">
                                <?php echo Html::submitButton('<span class="text-el" style="color:#fff">' . \Yii::t('app', 'Зарегистрироваться') . '</span>', ['style' => 'background: #34a4e7;', 'name' => 'login-button']) ?>
                            </div>
                            <p class="help-block"><?php echo \Yii::t('app', 'Я уже зарегистрирован'); ?></p>
                            <ul class="items items-register-add-ref">
                                <li>
                                    <a href="<?php echo Yii::$app->urlHelper->to(['login']); ?>" type="button">
                                        <span class="text-el d_l_1"><?php echo \Yii::t('app', 'Войти'); ?></span>
                                    </a>
                                </li>
                                <li>
                                    <span class="divider">|</span>
                                    <button type="button">
                                        <span class="text-el d_l_1"><?php echo \Yii::t('app', 'Напомнить пароль'); ?></span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>
<div class="h-footer"></div>