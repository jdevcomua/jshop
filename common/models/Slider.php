<?php

namespace common\models;

use SplFileInfo;
use Yii;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property string $title
 * @property string $largeTitle
 * @property string $description
 * @property string $image
 * @property int $type
 */

const MAIN_SLIDER = 1;
const CATEGORY_MIDLE_SLIDER = 2;
const CATEGORY_LEFT_SLIDER = 3;

class Slider extends ModelWithImage
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['title', 'largeTitle', 'description', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('app','Title'),
            'largeTitle' => Yii::t('app','Large Title'),
            'description' => Yii::t('app','Description'),
            'image' => Yii::t('app','Image'),
            'type' => Yii::t('app','Type'),
        ];
    }
    public function getImageUrl()
    {
        return Yii::$app->getRequest()->getHostInfo().Item::IMG.$this->image;
    }

    public function pathToFile($fileName, $size = null)
    {
        if(!empty($size)){
            $info = new SplFileInfo($fileName);
            $path_parts = pathinfo($fileName);
            return Yii::getAlias('@www') .Item::WEB_IMG.$path_parts['filename'] . $size . $info->getExtension();
        }else{
            return Yii::getAlias('@www') .Item::WEB_IMG.$fileName;
        }
    }

}
