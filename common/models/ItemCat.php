<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_cat".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Item[] $items
 */
class ItemCat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_cat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['category_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\search\ItemCatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\search\ItemCatQuery(get_called_class());
    }
}
