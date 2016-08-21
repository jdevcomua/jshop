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
class Banner extends Model
{

    const POSITION_INDEX_CENTER = 1;
    const POSITION_INDEX_RIGHT = 2;

    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function upload()
    {
        $file = UploadedFile::getInstance($this, 'imageFile');
        if (isset($file)) {
            $this->deleteImage(false);
            $fileName = $this->id . mt_rand() . '.' . $file->extension;
            $file->saveAs(Item::getPath() . $fileName);
            $this->image = $fileName;
            $this->save();
        }
    }

    public function deleteImage($save = true)
    {
        $oldImage = Item::getPath() . $this->image;
        if (!empty($this->image) && file_exists($oldImage) && !is_dir($oldImage)) {
            unlink($oldImage);
            $this->image = null;
            if ($save) {
                $this->save();
            }
        }
    }
    
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

    /**
     * @return array
     */
    public function getImageUrl()
    {
        return Yii::$app->params['myServerImageLink'] . $this->image;
    }

    public function getPositionTitle()
    {
        switch ($this->position) {
            case Banner::POSITION_INDEX_RIGHT: return 'Главная страница, справа'; break;
            case Banner::POSITION_INDEX_CENTER: return 'Главная страница, центр'; break;
            default: return '';
        }
    }
    
}
