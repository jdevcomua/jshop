<?php

namespace common\models;

use SplFileInfo;
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

    public function deleteImage($imageName)
    {
        if (file_exists($this->pathToFile($imageName))){
            unlink( $this->pathToFile($imageName));
        }

        if (file_exists($this->pathToFile($imageName, Item::SIZE))){
            unlink($this->pathToFile($imageName, Item::SIZE));
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