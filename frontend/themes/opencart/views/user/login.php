<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div id="content" class="col-sm-12">
    <div class="row">
        <div class="col-sm-6">
            <div class="well">
                <h2><?= Yii::t('app','Новый пользователь')?></h2>
                <p><strong><?= Yii::t('app','Регистрация')?></strong></p>
                <p><?= Yii::t('app', 'Регистрация описание')?></p>
                <a href="<?= Url::to(['user/register'])?>" class="btn btn-primary"><?= Yii::t('app', 'Продолжить')?></a></div>
        </div>
        <div class="col-sm-6">
            <div class="well">
                <h2><?= Yii::t('app', 'Авторизация')?></h2>
                <p><strong><?= Yii::t('app', 'Авторизация_описание')?></strong></p>
                <?php $form = ActiveForm::begin([

                ]); ?>
                <?= $form->field($model, 'username'); ?>
                <?= $form->field($model, 'password',['template' => "{label}\n{input}\n{hint}\n{error}" . Html::a(Yii::t('app','Напомнить пароль'),['user/forgot-password'])]); ?>
                <input type="submit" value="<?= Yii::t('app','Логин')?>" class="btn btn-primary">
                <?php ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>