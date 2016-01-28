<?php

namespace common\models;

use Yii;
use common\components\CartAdd;

/**
 * This is the model class for table "kit".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property double $cost
 *
 * @property KitItem[] $kitItems
 */
class Kit extends Model implements CartAdd
{

    const CART_TYPE = 2;

    public function getTranslateColumns()
    {
        return ['title', 'description'];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['cost'], 'number'],
            [['title'], 'string', 'max' => 255],
            [['title', 'cost'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название'),
            'description' => Yii::t('app', 'Описание'),
            'cost' => Yii::t('app', 'Стоимость'),
        ];
    }

    public function getImageUrl()
    {
        return ['http://dayfun.ru/wp-content/uploads/2013/11/%D0%9A%D0%B0%D0%BA-%D1%80%D0%B8%D1%81%D0%BE%D0%B2%D0%B0%D1%82%D1%8C-%D0%BA%D0%BE%D1%80%D0%BE%D0%B1%D0%BA%D1%83.jpg'];
    }

    /**
     * @return float
     */
    public function getNewPrice()
    {
        return $this->cost;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKitItems()
    {
        return $this->hasMany(KitItem::className(), ['kit_id' => 'id']);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return self::CART_TYPE;
    }
}
