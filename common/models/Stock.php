<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property integer $id
 * @property string $title
 * @property string $date_from
 * @property string $date_to
 * @property string $description
 * @property integer $type
 * @property integer $value
 *
 * @property StockItem[] $stockItems
 */
class Stock extends Model
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
        return 'stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_from', 'date_to'], 'safe'],
            [['description'], 'string'],
            [['type', 'value'], 'integer'],
            [['title'], 'string', 'max' => 255]
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
            'date_from' => Yii::t('app', 'От'),
            'date_to' => Yii::t('app', 'До'),
            'description' => Yii::t('app', 'Описание'),
            'type' => Yii::t('app', 'Метод подсчета'),
            'value' => Yii::t('app', 'Значение'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockItems()
    {
        return $this->hasMany(StockItem::className(), ['stock_id' => 'id']);
    }
}
