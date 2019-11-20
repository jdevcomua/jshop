<?php

namespace console\controllers\Parser\metro;

use common\models\Image;
use common\models\Item;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Yii;
use yii\imagine\BaseImage;

class PhotoParse extends Parse
{
    const SMALL_SIZE = 400;
    const LOGO_SIZE = 200;

    protected function process(array $itemArray, int $categoryId, Item $item = null)
    {
        $oldImage = isset($itemArray['main_image']['s1350x1350']) ? $itemArray['main_image']['s1350x1350'] : null;
        if($oldImage && $item && count($item->images) == 0){
            dg($itemArray['main_image'], 0);
            echo "\n$oldImage \n";
            $watermark = BaseImage::getImagine()->open(Yii::getAlias('@www/web/images/logo-sdelivery_' . self::LOGO_SIZE . '.png'));
            $imagine = BaseImage::getImagine()->open($oldImage);
            $size = $imagine->getSize();
            echo $size->getWidth() . 'x' . $size->getHeight() . "\n";
            if ($size->getWidth() > self::LOGO_SIZE && $size->getHeight() > self::LOGO_SIZE){
                $imagine->paste($watermark, new Point($size->getWidth() - self::LOGO_SIZE, $size->getHeight() - self::LOGO_SIZE));
                $uniqId = uniqid();
                $newImageName = $uniqId . '.' . $this->getImageExtension($oldImage);
                $newImageNameSmall = $uniqId . '_' . self::SMALL_SIZE . '.' . $this->getImageExtension($oldImage);
                $saveOptions = ['jpeg_quality' => 100, 'png_compression_level' => 1];
                $imagine->save(Yii::getAlias('@www/web/img') . '/' . $newImageName, $saveOptions);
                $imagine->resize(new Box(self::SMALL_SIZE,
                    $size->getHeight() * self::SMALL_SIZE / $size->getWidth()));
                $imagine->save(Yii::getAlias('@www/web/img') . '/' . $newImageNameSmall, $saveOptions);

                $item->save();
                $image = new Image();
                $image->name = $newImageName;
                $image->item_id = $item->id;
                $image->save();
            }
        }
    }
}