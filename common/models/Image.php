<?php

namespace common\models;

use SplFileInfo;
use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $name
 * @property integer $item_id
 * @property string $storage
 * @property string $small
 * @property string $created_at
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
            [['name', 'storage', 'small'], 'string'],
            [['created_at'], 'safe'],
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
            'created_at' => Yii::t('app', 'Дата создания'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::class, ['id' => 'item_id']);
    }

    /**
     * @param string $size
     * @return string
     */
    public function getImageUrl()
    {
        $info = new SplFileInfo($this->name);
        $path_parts = pathinfo($this->name);
        if(file_exists(  Yii::getAlias('@www') . '/web'. Item::IMG . $path_parts['filename']. Item::SIZE. $info->getExtension())){
            return Yii::$app->params['serverUrl'] . Item::IMG . $path_parts['filename']. Item::SIZE. $info->getExtension();
        }else{
            return Yii::$app->params['defaultKitImage'];
        }
    }
}
