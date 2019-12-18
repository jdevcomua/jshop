<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "manufacturer".
 *
 * @property int $id
 * @property string $name
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
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    public function getItems()
    {
        return $this->hasMany(Item::class, ['manufacturer_id' => 'id']);
    }

    public static function getManufacturerNames()
    {
        $model = Manufacturer::find()->select(['id', 'name'])->all();
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
}
