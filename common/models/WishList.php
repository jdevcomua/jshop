<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wish_list".
 *
 * @property integer $id
 * @property string $title
 * @property integer $user_id
 *
 * @property Wish[] $wishes
 * @property User $user
 */
class WishList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wish_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название списка'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWishes()
    {
        return $this->hasMany(Wish::className(), ['list_id' => 'id'])->joinWith('item');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
