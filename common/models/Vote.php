<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vote".
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $user_id
 * @property string $timestamp
 * @property string $text
 * @property integer $rating
 * @property integer $checked
 *
 * @property Item $item
 * @property User $user
 */
class Vote extends Model
{
    
    const STATUS_CHECKED = 1;
    const STATUS_NOT_CHECKED = 0;
    const STATUS_HIDDEN = -1;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vote';
    }

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
    public function rules()
    {
        return [
            [['item_id', 'text', 'rating'], 'required'],
            [['item_id', 'user_id', 'rating', 'checked'], 'integer'],
            [['timestamp'], 'safe'],
            [['text'], 'string'],
            [['checked'], 'default', 'value' => self::STATUS_NOT_CHECKED],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'ID товара',
            'user_id' => 'ID пользователя',
            'timestamp' => 'Время создания',
            'text' => 'Текст',
            'rating' => 'Рейтинг',
            'itemTitle' => 'Товар',
            'checked' => 'Статус',
        ];
    }

    public function getItemTitle()
    {
        return $this->item->title;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return \yii\db\ActiveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \yii\db\ActiveQuery(get_called_class());
    }
}
