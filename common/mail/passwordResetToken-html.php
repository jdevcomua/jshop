<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl([Yii::$app->request->get('language', '') . '/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Здравствуйте!</p>

    <p>Вы запросили смену пароля на сайте <?= Yii::$app->name ?>. Чтобы восстановить пароль, нажмите на ссылку ниже.</p>

    <p><?php echo Html::a(Html::encode($resetLink), $resetLink) ?></p>

    <p>Если это письмо попало к Вам по ошибке просто проигнорируйте его.</p>

    <p>С уважением, <br>
        администрация сайта "<a href="<?= Yii::$app->urlManager->createAbsoluteUrl('/'); ?>"><?= Yii::$app->name ?></a>"</p>
</div>
