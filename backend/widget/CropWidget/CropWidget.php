<?php

namespace backend\widget\CropWidget;

use common\models\Image;
use common\models\ItemCat;
use yii\helpers\Json;
use Yii;

class CropWidget extends \budyaga\cropper\Widget
{
    public $uploadParameter = 'file';
    public $width = 400;
    public $height = 400;
    public $label = '';
    public $uploadUrl;
    public $noPhotoImage = '';
    public $maxSize = 2097152;
    public $thumbnailWidth = 300;
    public $thumbnailHeight = 300;
    public $cropAreaWidth = 600;
    public $cropAreaHeight = 430;
    public $extensions = 'jpeg, jpg, png, gif';
    public $onCompleteJcrop= 'croperSuccess(response);'; // !!! Сюда можно дописать  callback js который хочешь в ввиде строки
    public $pluginOptions = [];
    public $aspectRatio = null;


    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerClientAssets();
        $catmodel = new ItemCat();
        if($this->model->image){
            $catmodel->image = $this->model->image;
            $image=NULL;
        }elseif($this->model->imageFiles){
            $image = Image::findOne(['item_id'=>$this->model->id]);
        }else{
            $image=NULL;
        }
        return $this->render('cropwidget', [
            'model' => $this->model,
            'widget' => $this,
            'image'=>$image,
            'catmodel'=>$catmodel,
        ]);
    }

    /**
     * Register widget asset.
     */
    public function registerClientAssets()
    {
        $view = $this->getView();
        $assets = CropperAsset::register($view);

        if ($this->noPhotoImage == '') {
            $this->noPhotoImage = $assets->baseUrl . '/img/noimage.png';
        }

        $settings = array_merge([
            'url' => $this->uploadUrl,
            'name' => $this->uploadParameter,
            'maxSize' => $this->maxSize / 1024,
            'allowedExtensions' => explode(', ', $this->extensions),
            'size_error_text' => Yii::t('cropper', 'TOO_BIG_ERROR', ['size' => $this->maxSize / (1024 * 1024)]),
            'ext_error_text' => Yii::t('cropper', 'EXTENSION_ERROR', ['formats' => $this->extensions]),
            'accept' => 'image/*',
        ], $this->pluginOptions);

        if(is_numeric($this->aspectRatio)) {
            $settings['aspectRatio'] = $this->aspectRatio;
        }

        if ($this->onCompleteJcrop)
            $settings['onCompleteJcrop'] = $this->onCompleteJcrop;

        $view->registerJs(
            'jQuery("#' . $this->options['id'] . '").parent().find(".new-photo-area").cropper(' . Json::encode($settings) . ', ' . $this->width . ', ' . $this->height . ');',
            $view::POS_READY
        );
    }

}
