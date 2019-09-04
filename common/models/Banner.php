<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $image
 * @property string $url
 * @property string $position
 * @property integer $enable
 */
class Banner extends ModelWithImage
{

    const POSITION_INDEX_CENTER = 1;
    const POSITION_INDEX_RIGHT = 2;
    public $dir = 'banners';

    /**
     * @var UploadedFile
     */
    public $imageFile;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
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
            [['enable'], 'integer'],
            [['enable'], 'default', 'value' => 0],
            [['image', 'url', 'position'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Изображение',
            'url' => 'Url',
            'position' => 'Позиция',
            'enable' => 'Включено',
            'imageFile' => 'Изображение',
            'imageUrl' => 'Изображение',
            'positionTitle' => 'Позиция',
        ];
    }

    public function getPositionTitle()
    {
        switch ($this->position) {
            case Banner::POSITION_INDEX_RIGHT: return 'Главная страница, справа'; break;
            case Banner::POSITION_INDEX_CENTER: return 'Главная страница, центр'; break;
            default: return '';
        }
    }

    public function upload()
    {
        $file = UploadedFile::getInstance($this, 'imageFile');
        if (isset($file)) {
            $fileName = $this->id . mt_rand() . '.' . $file->extension;
            $this->deleteImage($fileName);
            $file->saveAs($this->getPath() . $fileName);
            $this->image = $fileName;
            $this->save();
        }
    }

    public function getImageUrl()
    {
        if(file_exists(Yii::getAlias('@www') . '/web'. Item::IMG .'banners/'. $this->image)){
            return Yii::$app->params['serverUrl'] . Item::IMG .'banners/'. $this->image;
        }else{
            return Yii::$app->params['defaultKitImage'];
        }

    }
    
}
