<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "characteristic_item".
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $characteristic_id
 * @property string $value
 *
 * @property Item $item
 * @property Characteristic $characteristic
 */
class CharacteristicItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characteristic_item';
    }

    public function getCharacteristicTitle(){
        return $this->characteristic->title;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'characteristic_id'], 'integer'],
            [['value'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', 'ID товара'),
            'characteristic_id' => Yii::t('app', 'ID характеристики'),
            'value' => Yii::t('app', 'Значение'),
            'characteristicTitle' => Yii::t('app', 'Характеристика'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristic()
    {
        return $this->hasOne(Characteristic::className(), ['id' => 'characteristic_id']);
    }
}
