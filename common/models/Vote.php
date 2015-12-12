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
 *
 * @property Item $item
 * @property User $user
 */
class Vote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'text'], 'required'],
            [['item_id', 'user_id'], 'integer'],
            [['timestamp'], 'safe'],
            [['text'], 'string']
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
        ];
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
     * @return \common\models\search\VoteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\search\VoteQuery(get_called_class());
    }
}
