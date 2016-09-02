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
 * @property float $float_value
 *
 * @property Item $item
 * @property Characteristic $characteristic
 */
class CharacteristicItem extends Model
{
    
    public $count;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characteristic_item';
    }

    /**
     * @return array
     */
    public function getTranslateColumns()
    {
        return ['value'];
    }

    /**
     * @return string
     */
    public function getCharacteristicTitle()
    {
        return $this->characteristic->title;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'characteristic_id'], 'integer'],
            [['float_value'], 'double'],
            [['value'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (isset($this->characteristic_id)) {
                $characteristic = Characteristic::findOne($this->characteristic_id);
                if ($characteristic && $characteristic->type == Characteristic::TYPE_RANGE && !empty($this->value)) {
                    $this->float_value = floatval($this->value);
                }
            }
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
            'item_id' => Yii::t('app', 'ID товара'),
            'characteristic_id' => Yii::t('app', 'ID характеристики'),
            'value' => Yii::t('app', 'Значение'),
            'characteristicTitle' => Yii::t('app', 'Характеристика'),
            'float_value' => Yii::t('app', 'Числовое значение'),
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
