<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property double $cost
 * @property string $image
 *
 * @property CharacteristicItem[] $characteristicItems
 * @property ItemCat $category
 * @property OrderItem[] $orderItems
 * @property Vote[] $votes
 */
class Item extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function getTranslateColumns(){
        return ['title'];
    }

    public function getCategoryTitle(){
        return $this->category->title;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    public static function getPath(){
        return Yii::getAlias('@frontend').'/web/img/';
    }

    public function getImageUrl(){
        return 'http://frontend.dev/img/'.$this->image;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['title', 'cost'], 'required'],
            [['cost'], 'number'],
            [['title'], 'string'],
            [['image'], 'string', 'max' => 25],
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function upload()
    {
        if (isset($this->imageFile)) {
            $this->setAttribute('image', $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
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
            'cost' => Yii::t('app', 'Стоимость'),
            'image' => Yii::t('app', 'Изображение'),
            'categoryTitle' => Yii::t('app', 'Категория'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristicItems()
    {
        return $this->hasMany(CharacteristicItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ItemCat::className(), ['id' => 'category_id']);
    }

    public static function getCategorys()
    {
        //Категории, в которых есть предметы
        $parents = Item::find()
            ->select(['i.title'])
            ->join('JOIN', 'item_cat i', 'item.category_id = i.id')
            ->distinct(true)
            ->all();

        return ArrayHelper::map($parents, 'title', 'title');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Vote::className(), ['item_id' => 'id']);
    }
}
