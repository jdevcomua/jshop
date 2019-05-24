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
    public $imageFiles;
    
    public function getTranslateColumns()
    {
        return [];
    }

    public function deleteImage()
    {

        if (file_exists(Yii::getAlias('@www') .Item::WEB_IMG.$this->image)) {
            unlink( Yii::getAlias('@www') .Item::WEB_IMG. $this->image);
            return NULL;
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
        return Yii::getAlias('@www') . '/web/img/' . ($this->dir != '' ? $this->dir . '/' : '');
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return Yii::$app->getRequest()->getHostInfo().Item::IMG.$this->image;
    }

}