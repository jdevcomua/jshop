<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "characteristic".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 *
 * @property ItemCat $category
 * @property CharacteristicItem[] $characteristicItems
 */
class Characteristic extends Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characteristic';
    }

    public function getTranslateColumns(){
        return ['title'];
    }

    public function getCategoryTitle(){
        return $this->category->title;
    }

    public static function getCategorys()
    {
        // Выбираем только те категории, у которых есть дочерние категории
        $parents = Characteristic::find()
            ->select(['i.title'])
            ->join('JOIN', 'item_cat i', 'characteristic.category_id = i.id')
            ->distinct(true)
            ->all();

        return ArrayHelper::map($parents, 'title', 'title');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['title'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Категория'),
            'title' => Yii::t('app', 'Название'),
            'categoryTitle' => Yii::t('app', 'Категория'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ItemCat::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristicItems()
    {
        return $this->hasMany(CharacteristicItem::className(), ['characteristic_id' => 'id']);
    }
}
