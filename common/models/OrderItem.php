<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $order_id
 * @property integer $count
 * @property double $sum
 *
 * @property Item $item
 * @property Orders $order
 */
class OrderItem extends Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * @return array
     */
    public function getTranslateColumns()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'order_id', 'count'], 'required'],
            [['item_id', 'order_id', 'count'], 'integer'],
            [['sum'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'order_id' => 'Order ID',
            'count' => 'Count',
            'sum' => 'Sum',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);//->joinWith('category');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);//->joinWith('user');
    }

    /**
     * @inheritdoc
     * @return \yii\db\ActiveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \yii\db\ActiveQuery(get_called_class());
    }
}
