<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property double $cost
 * @property string $image
 *
 * @property ItemCat $category
 * @property OrderItem[] $orderItems
 * @property Vote[] $votes
 */
class Item extends \yii\db\ActiveRecord
{

    /**
     * @var UploadedFile
     */
    public $imageFile;

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
            [['title'], 'string', 'max' => 250],
            [['image'], 'string', 'max' => 25],
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
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
            'category_id' => Yii::t('app', 'ID категории'),
            'title' => Yii::t('app', 'Название'),
            'cost' => Yii::t('app', 'Стоимость'),
            'image' => Yii::t('app', 'Изображение'),
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
