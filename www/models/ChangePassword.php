<?php
/**
 * Created by PhpStorm.
 * User: umka
 * Date: 31.08.16
 * Time: 0:32
 */

namespace www\models;

use common\models\User;
use Yii;
use yii\base\Model;

class ChangePassword extends Model
{

    public $oldPassword;
    public $newPassword;
    public $confirmNewPassword;

    private $_user = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldPassword', 'newPassword', 'confirmNewPassword'], 'required'],
            [['oldPassword', 'newPassword', 'confirmNewPassword'], 'string', 'min' => 6],
            ['confirmNewPassword', 'compare', 'compareAttribute' => 'newPassword', 'operator' => '=='],
            ['oldPassword', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->oldPassword)) {
                $this->addError($attribute, 'Неверно указан старый пароль');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oldPassword' => 'Старый пароль',
            'newPassword' => 'Новый пароль',
            'confirmNewPassword' => 'Повторите пароль',
        ];
    }

    /**
     * Save new password
     *
     * @return bool
     */
    public function changePassword()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            if ($user) {
                $user->setPassword($this->newPassword);
                return $user->save();
            }
        }
        return false;
    }

    /**
     * Get current user
     *
     * @return User|null
     */
    public function getUser()
    {
        if (!$this->_user) {
            $this->_user = User::findOne(Yii::$app->user->id);
        }

        return $this->_user;
    }

    public function facebook()
    {
        $model = $this->getUser();

        if (!empty($model->fb_id) && empty($model->password_hash)) {
            return true;
        }
        return false;
    }

}