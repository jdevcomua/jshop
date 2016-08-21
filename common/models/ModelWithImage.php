<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * Class ModelWithImage
 *
 * @property integer $id
 * @property string $image
 */
class ModelWithImage extends Model
{

    public $dir = '';

    /**
     * @var UploadedFile
     */
    public $imageFile;
    
    public function getTranslateColumns()
    {
        return [];
    }

    public function upload()
    {
        $file = UploadedFile::getInstance($this, 'imageFile');
        if (isset($file)) {
            $this->deleteImage(false);
            $fileName = $this->id . mt_rand() . '.' . $file->extension;
            $file->saveAs($this->getPath() . $fileName);
            $this->image = $fileName;
            $this->save();
        }
    }

    public function deleteImage($save = true)
    {
        $oldImage = $this->getPath() . $this->image;
        if (!empty($this->image) && file_exists($oldImage) && !is_dir($oldImage)) {
            unlink($oldImage);
            $this->image = null;
            if ($save) {
                $this->save();
            }
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $this->deleteImage();
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string path of dir with images
     */
    public function getPath()
    {
        return Yii::getAlias('@frontend') . '/web/img/' . ($this->dir != '' ? $this->dir . '/' : '');
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return Yii::$app->params['myServerImageLink'] . ($this->dir != '' ? $this->dir . '/' : '') . $this->image;
    }

}