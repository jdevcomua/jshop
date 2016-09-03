<?php

namespace common\models;

use common\models\query\ItemCatQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use Yii;
use dosamigos\transliterator\TransliteratorHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "item_cat".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 * @property string $image
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property integer $tree
 *
 * @property Characteristic[] $characteristics
 * @property Item[] $items
 * @property ItemCat[] children
 * 
 * @method integer|false deleteWithChildren()
 * @method boolean makeRoot(boolean $runValidation = true, array $attributes = null)
 * @method boolean appendTo(ActiveRecord $node, boolean $runValidation = true, array $attributes = null)
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
    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                 'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
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
     * @return ItemCatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemCatQuery(get_called_class());
    }

    /**
     * @return ItemCat
     */
    public function getParent()
    {
        return $this->hasOne(ItemCat::className(), ['id' => 'parent_id']);
    }

    /**
     * Return url to this category
     *
     * @return string
     */
    public function getUrl()
    {
        return Yii::$app->urlHelper->to(['category/' . $this->id . '-' . $this->getTranslit()]);
    }
}
