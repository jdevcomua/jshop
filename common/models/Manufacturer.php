<?php

namespace common\models;

use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "manufacturer".
 *
 * @property int $id
 * @property string $name
 * @property string $metro_name
 *
 * @property Item[] $items
 */
class Manufacturer extends \yii\db\ActiveRecord
{
    public $quantity;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manufacturer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'metro_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app','Name'),
            'metro_name' => Yii::t('app','Metro Name'),
        ];
    }

    public function getItems()
    {
        return $this->hasMany(Item::class, ['manufacturer_id' => 'id']);
    }

    public static function getManufacturerNames()
    {
        $model = Manufacturer::find()->select(['id', 'name'])->orderBy('name')->all();
        $model = ArrayHelper::map($model, 'id', 'name');
        return $model;
    }

    public static function getItemFilterByName()
    {
        $manufacturers = Manufacturer::find()
            ->select(['manufacturer.name'])
            ->join('JOIN', 'item', 'item.manufacturer_id = manufacturer.id')
            ->all();
        return ArrayHelper::map($manufacturers, 'name', 'name');
    }

    public static function getManufacturesWithQuantity($categoryIds = null)
    {
        $q = Manufacturer::find()
            ->innerJoinWith('items')
            ->select(['manufacturer.id','manufacturer.name', new Expression('count(*) as quantity')])
            ->where(['item.active' => Item::ACTIVE_YES])
            ->groupBy('manufacturer.id')
            ->orderBy('manufacturer.name');
        if ($categoryIds){
            $q->andWhere(['item.category_id' => $categoryIds]);
        }
        return $q->all();
    }
}
