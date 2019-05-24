<?php

namespace backend\widget\CropWidget\actions;

use Imagine\Image\ImageInterface;
use SplFileInfo;
use yii\base\Action;
use yii\base\DynamicModel;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use budyaga\cropper\Widget;
use yii\imagine\Image;
use Imagine\Image\Box;
use common\models\Item;
use Yii;
use yii\imagine\BaseImage;

class UploadAction extends Action
{
    public $path;
    public $url;
    public $uploadParam = 'file';
    public $maxSize = 2097152;
    public $extensions = 'jpeg, jpg, png, gif';
    public $width = 200;
    public $height = 200;
    public $jpegQuality = 100;
    public $pngCompressionLevel = 1;

    /**
     * @inheritdoc
     */
    public function init()
    {
        Widget::registerTranslations();
        if ($this->url === null) {
            throw new InvalidConfigException(Yii::t('cropper', 'MISSING_ATTRIBUTE', ['attribute' => 'url']));
        } else {
            $this->url = rtrim($this->url, '/') . '/';
        }
        if ($this->path === null) {
            throw new InvalidConfigException(Yii::t('cropper', 'MISSING_ATTRIBUTE', ['attribute' => 'path']));
        } else {
            $this->path = rtrim(Yii::getAlias($this->path), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (Yii::$app->request->isPost) {
            $file = UploadedFile::getInstanceByName($this->uploadParam);
            $model = new DynamicModel(compact($this->uploadParam));
            $model->addRule($this->uploadParam, 'image', [
                'maxSize' => $this->maxSize,
                'tooBig' => Yii::t('cropper', 'TOO_BIG_ERROR', ['size' => $this->maxSize / (1024 * 1024)]),
                'extensions' => explode(', ', $this->extensions),
                'wrongExtension' => Yii::t('cropper', 'EXTENSION_ERROR', ['formats' => $this->extensions])
            ])->validate();

            if ($model->hasErrors()) {
                $result = [
                    'error' => $model->getFirstError($this->uploadParam)
                ];
            } else {
                $model->{$this->uploadParam}->name = uniqid() . '.' . $model->{$this->uploadParam}->extension;
                $request = Yii::$app->request;

                $width = $request->post('width', $this->width);
                $height = $request->post('height', $this->height);
                $origin = self::ensureImageInterfaceInstance($file->tempName . $request->post('filename'));
                $image = Image::crop(
                    $origin,
                    intval($request->post('w')),
                    intval($request->post('h')),
                    [$request->post('x'), $request->post('y')]
                )->resize(
                    new Box($width, $height)
                );

                if (!file_exists($this->path) || !is_dir($this->path)) {
                    $result = [
                        'error' => Yii::t('cropper', 'ERROR_NO_SAVE_DIR')]
                    ;
                } else {
                    $saveOptions = ['jpeg_quality' => $this->jpegQuality, 'png_compression_level' => $this->pngCompressionLevel];
                    $origin->save($this->path . $model->{$this->uploadParam}->name, $saveOptions);
                    $info = new SplFileInfo($model->{$this->uploadParam}->name);
                    $path_parts = pathinfo($model->{$this->uploadParam}->name);
                    $newname = Yii::getAlias('@www') .Item::WEB_IMG.$path_parts['filename'].'_origin.'.$info->getExtension();
                    rename(Yii::getAlias('@www') .Item::WEB_IMG.$model->{$this->uploadParam}->name, $newname);

                    if ($image->save($this->path . $model->{$this->uploadParam}->name, $saveOptions)) {
                        $result = [
                            'filelink' => $this->url . $model->{$this->uploadParam}->name
                        ];
                    } else {
                        $result = [
                            'error' => Yii::t('cropper', 'ERROR_CAN_NOT_UPLOAD_FILE')
                        ];
                    }
                }
            }
            Yii::$app->response->format = Response::FORMAT_JSON;

            return $result;
        } else {
            throw new BadRequestHttpException(Yii::t('cropper', 'ONLY_POST_REQUEST'));
        }
    }
    public static function ensureImageInterfaceInstance($image)
    {
        if ($image instanceof ImageInterface) {
            return $image;
        }

        if (is_resource($image)) {
            return BaseImage::getImagine()->read($image);
        }

        if (is_string($image)) {
            return BaseImage::getImagine()->open(Yii::getAlias($image));
        }

        throw new InvalidParamException('File should be either ImageInterface, resource or a string containing file path.');
    }
}
