<?php

namespace common\models;

use SplFileInfo;
use Yii;
use yii\web\UploadedFile;

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



class Slider extends ModelWithImage
{
    /**
     * {@inheritdoc}
     */
    const MAIN_SLIDER = 1;
    const BRAND_SLIDER = 2;
    public $imageFile;

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
            [['title', 'largeTitle', 'description'], 'string', 'max' => 255],
            [[ 'imageFile'], 'image', 'extensions' => 'png, jpg, jpeg','maxHeight'=>721,'maxWidth'=>1281,'minHeight'=>719,'minWidth'=>1279],
            [[ 'image'], 'image', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('app','Название'),
            'largeTitle' => Yii::t('app','Длинное Название'),
            'description' => Yii::t('app','Описание'),
            'image' => Yii::t('app','Рисунок'),
            'type' => Yii::t('app','Тип'),
        ];
    }
    public function getImageUrl()
    {
        return Yii::$app->getRequest()->getHostInfo().Item::IMG.$this->image;
    }

    public function beforeDelete()
    {
        if(isset($this->image) && file_exists($this->pathToFile($this->image))){
            return unlink( $this->pathToFile($this->image));
        }else{
            return true;
        }
    }

    public function upload()
    {
        $file = UploadedFile::getInstance($this, 'imageFile');
        if (isset($file)) {
            $fileName = $this->id . mt_rand() . '.' . $file->extension;
            if(!empty($this->getAttribute('image'))){
                $this->deleteImage($this->getAttribute('image'));
            }
            $this->deleteImage($fileName);
            $file->saveAs($this->getPath() . $fileName);
            $this->image = $fileName;
        }
    }
    public static function getSliderTypes()
    {
        return [
            static::MAIN_SLIDER => 'Главное меню',
            static::BRAND_SLIDER => 'Cлайдер брендов',
        ];
    }
    public function getSliderType()
    {
        $titles = static::getSliderTypes();

        return key_exists($this->type, $titles) ? $titles[$this->type] : null;
    }


}
