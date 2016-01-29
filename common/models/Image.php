<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $name
 * @property integer $item_id
 * @property string $storage
 * @property string $small
 *
 * @property Item $item
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id'], 'integer'],
            [['name', 'storage', 'small'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'item_id' => Yii::t('app', 'Item ID'),
            'storage' => Yii::t('app', 'Storage'),
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
     * @param string $size
     * @return string
     */
    public function getImageUrl($size = '')
    {
        if (!empty($size) && empty($this->small)) {
            $size = '';
        }
        if ($this->storage == Item::MY_SERVER) {
            return 'http://frontend.dev/img/' . $size . $this->name;
        } elseif ($this->storage == Item::AMAZON) {
            return 'https://s3.eu-central-1.amazonaws.com/' . Item::AMAZON_BUCKET . '/' . $size . $this->name;
        }
    }
}
