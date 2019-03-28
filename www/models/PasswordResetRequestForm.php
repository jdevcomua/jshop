<?php
namespace www\models;

use common\models\Orders;
use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $mail;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['mail', 'filter', 'filter' => 'trim'],
            ['mail', 'required'],
            ['mail', 'email'],
            ['mail', 'exist',
                'targetClass' => '\common\models\User',
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'mail' => $this->mail,
        ]);

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                return \Yii::$app->mailer->compose(['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->mail)
                    ->setSubject('Сброс пароля, ' . \Yii::$app->name)
                    ->send();
            }
        }

        return false;
    }
}
