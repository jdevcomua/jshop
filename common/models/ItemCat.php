<?php

namespace common\models;

use Yii;
use dosamigos\transliterator\TransliteratorHelper;

/**
 * This is the model class for table "item_cat".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 * @property string $image
 *
 * @property Characteristic[] $characteristics
 * @property Item[] $items
 * @property ItemCat[] children
 */
class ItemCat extends ModelWithImage
{
    
    public $count;
    public $dir = 'categories';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_cat';
    }

    /**
     * @return array
     */
    public function getTranslateColumns()
    {
        return ['title'];
    }

    public function getTranslit()
    {
        return str_replace(['/', ' '], '_', TransliteratorHelper::process($this->title, '', 'en'));
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'image'], 'string'],
            ['parent_id', 'integer']
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
            'parent_id' => 'Родительская категория',
            'image' => 'Изображение',
            'imageFile' => 'Изображение',
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
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristics()
    {
        return $this->hasMany(Characteristic::className(), ['category_id' => 'id'])->indexBy('id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(ItemCat::className(), ['parent_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \yii\db\ActiveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \yii\db\ActiveQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ItemCat::className(), ['id' => 'parent_id']);
    }

    public function getUrl()
    {
        return Yii::$app->urlHelper->to(['category/' . $this->id . '-' . $this->getTranslit()]);
    }
}
