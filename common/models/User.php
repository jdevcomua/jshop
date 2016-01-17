<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $mail
 * @property string $city
 * @property string $password
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string $address
 * @property integer $vk_id
 *
 * @property Orders[] $orders
 * @property Vote[] $votes
 * @property WishList[] $wishLists
 */
class User extends Model implements \yii\web\IdentityInterface
{
    /*
        public $username;
        public $password;
        public $authKey;
        public $accessToken;*/

    /**
     * @return array
     */
    public function getTranslateColumns()
    {
        return [];
    }

    /**
     * @var array
     *
    private static $users = [
    '100' => [
    'id' => '100',
    'username' => 'admin',
    'password' => 'admin',
    'authKey' => 'test100key',
    'accessToken' => '100-token',
    ],
    '101' => [
    'id' => '101',
    'username' => 'demo',
    'password' => 'demo',
    'authKey' => 'test101key',
    'accessToken' => '101-token',
    ],
    ];*/

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        if (!empty(User::findOne($id))) {
            return new static(User::findOne($id));
        } else {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        if (!empty(User::find()->andFilterWhere(['username' => $username])->all()[0])) {
            return new static(User::find()->andFilterWhere(['username' => $username])->all()[0]);
        } else {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return 'test101key';
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
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
            //[['username', 'mail'/*, 'password'*/], 'required'],
            [['username', 'mail', 'vk_id'], 'unique'],
            [['username', 'mail'], 'trim'],// обрезает пробелы вокруг "username" и "email"
            [['username'], 'string', 'length' => [4, 25]],
            //[['password'], 'string', 'length' => [4, 25]],
            [['name', 'surname', 'address', 'phone'], 'string'],
            [['mail'], 'email']

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Логин'),
            'mail' => Yii::t('app', 'E-mail'),
            'city' => Yii::t('app', 'Город'),
            'password' => Yii::t('app', 'Пароль'),
            'address' => Yii::t('app', 'Адрес'),
            'phone' => Yii::t('app', 'Телефон'),
            'name' => Yii::t('app', 'Имя'),
            'surname' => Yii::t('app', 'Фамилия'),
        ];
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

}
