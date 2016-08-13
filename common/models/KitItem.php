<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "kit_item".
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $kit_id
 * @property boolean $is_main_item
 *
 * @property Item $item
 * @property Kit $kit
 */
class KitItem extends Model
{

    public function getTranslateColumns()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kit_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'kit_id'], 'integer'],
            [['is_main_item'], 'boolean'],
            [['is_main_item'], 'default', 'value' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'kit_id' => Yii::t('app', 'Kit ID'),
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
    public function getKit()
    {
        return $this->hasOne(Kit::className(), ['id' => 'kit_id']);
    }
}
