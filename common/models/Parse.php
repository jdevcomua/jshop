<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parse".
 *
 * @property int $id
 * @property string $url
 * @property string $parse_time
 * @property int $category_id
 *
 * @property ItemCat $category
 * @property string $slug
 */
class Parse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['parse_time'], 'safe'],
            [['url'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemCat::className(), 'targetAttribute' => ['category_id' => 'id']],
            ['url','url'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'slug' => 'Slug',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ItemCat::className(), ['id' => 'category_id']);
    }

    public function getSlug(){
        $slug = str_replace("https://metro.zakaz.ua/ru/", '',$this->url);
        $slug = str_replace("https://metro.zakaz.ua/uk/", '',$slug);
        $slug = str_replace(" ", '',$slug);
        $slug = str_replace("/", '',$slug);
        return $slug;
    }
}
