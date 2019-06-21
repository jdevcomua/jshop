<?php

namespace common\models;

use budyaga\users\models\AuthAssignment;
use budyaga\users\models\AuthItem;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $email
 * @property string $city
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string $address
 * @property integer $vk_id
 * @property integer $fb_id
 * @property string $access_token
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 * @property string $created
 *
 * @property string $username
 *
 * @property Orders[] $orders
 * @property Vote[] $votes
 * @property WishList[] $wishLists
 * @property AuthItem[] $assignedRules
 * @property AuthAssignment[] $assignments
 */
class User extends Model implements \yii\web\IdentityInterface
{

    public $password;

    public $confirm_password;

    /**
     * @return array
     */
    public function getTranslateColumns()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['password'], 'required', 'on' => 'vPass'],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'operator' => '==', 'on' => 'adminPass'],
            ['password', 'compare', 'compareAttribute' => 'confirm_password', 'operator' => '==', 'on' => 'adminPass'],
            [['email', 'vk_id', 'fb_id'], 'unique'],
            [['email'], 'trim'],// обрезает пробелы вокруг "email"
            [['address','name','surname'],'length' => [0, 50]],
            [['password'], 'string', 'length' => [6, 25]],
            [['name', 'surname', 'address', 'phone', 'access_token', 'password','city'], 'string'],
            [['email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'E-mail'),
            'city' => Yii::t('app', 'Город'),
            'password' => Yii::t('app', 'Пароль'),
            'address' => Yii::t('app', 'Адрес'),
            'phone' => Yii::t('app', 'Телефон'),
            'name' => Yii::t('app', 'Имя'),
            'surname' => Yii::t('app', 'Фамилия'),
            'created' => Yii::t('app', 'Время создания'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return User::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by email
     *
     * @param  string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return User::findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUserName()
    {
        return $this->name . ' ' . $this->surname;
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Vote::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWishLists()
    {
        return $this->hasMany(WishList::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
    }

    public function getAssignedRules()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->via('assignments');
    }

    public function getNotAssignedRules()
    {
        return AuthItem::find()->where(['not in', 'name', ArrayHelper::getColumn($this->assignedRules, 'name')])->all();
    }

}
