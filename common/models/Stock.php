<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

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
 * @property string $image
 *
 * @property StockItem[] $stockItems
 * @property Item[] $items
 */
class Stock extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function getTranslateColumns()
    {
        return ['title'];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * @return array
     */
    public function getImageUrl()
    {
        return 'http://frontend.dev/img/' . $this->image;
    }

    public function upload()
    {
        $file = UploadedFile::getInstance($this, 'imageFile');
        if (isset($file)) {
            if (isset($this->image)) {
                if (file_exists(Item::getPath() . $this->image)) {
                    unlink(Item::getPath() . $this->image);
                }
            }
            $fileName = $this->id . mt_rand() . '.' . $file->extension;
            $file->saveAs(Item::getPath() . $fileName);
            $this->image = $fileName;
            $this->save();
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_from', 'date_to'], 'safe'],
            [['description', 'image', 'title'], 'string'],
            [['type', 'value'], 'integer'],
            [['title'], 'required'],
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
            'image' => Yii::t('app', 'Изображение'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockItems()
    {
        return $this->hasMany(StockItem::className(), ['stock_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])->viaTable('stock_item', ['stock_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getCurrent()
    {
        return Stock::find()->andFilterWhere(['<', 'date_from', date('Y-m-d H:i:s')])
        ->andFilterWhere(['>', 'date_to', date('Y-m-d H:i:s')]);
    }
}
