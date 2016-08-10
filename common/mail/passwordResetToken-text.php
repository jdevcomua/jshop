<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl([Yii::$app->request->get('language', '') . '/reset-password', 'token' => $user->password_reset_token]);
?>
Здравствуйте, <?php echo $user->username ?>,

Вы запросили смену пароля на сайте <?= Yii::$app->name  ?>. Чтобы восстановить пароль, нажмите на ссылку ниже.

<?php echo $resetLink ?>
