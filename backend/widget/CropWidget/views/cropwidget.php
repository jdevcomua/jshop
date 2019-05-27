<?php
/**
 * @var \yii\db\ActiveRecord $model
 * @var CropWidget $widget
 * @var ItemCat $catmodel
 * @var Image $image
 */

use backend\widget\CropWidget\CropWidget;
use common\models\Image;
use common\models\ItemCat;
use yii\bootstrap\Modal;
use yii\helpers\Html;



?>

<div class="cropper-widget">
    <?= Html::activeHiddenInput($model, $widget->attribute, ['class' => 'photo-field']); ?>
    <?= Html::hiddenInput('width', $widget->width, ['class' => 'width-input']); ?>
    <?= Html::hiddenInput('height', $widget->height, ['class' => 'height-input']); ?>
    <div class="new-photo" style="height: <?= $widget->cropAreaHeight; ?>px; width: <?= $widget->cropAreaWidth; ?>px;">

            <?php if ($image != NULL):?>
                <input class="" type="button" id="deleteimage" onclick="deleteImage(event, this)" value="X" style="margin-bottom: 0;font-weight: normal;text-align: center;white-space: nowrap;vertical-align: middle;-ms-touch-action: manipulation;touch-action: manipulation;cursor: pointer;background-image: none;border:  1px solid transparent;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;border-radius: 4px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;color: #fff;background-color: #d9534f;float: right">
                <div class="dropzone disable" id="dropzone">
                    <span id="spanfornewfoto" class="spanNone"><?= $widget->label;?></span>
                    <img id="newphoto" src="<?=Yii::$app->getRequest()->getHostInfo()?>/img/<?=$image->name?>">
                </div>
            <?php elseif($catmodel->image != NULL): ?>
                <input class="" type="button" id="deleteimage" onclick="deleteImage(event, this)" value="X" style="margin-bottom: 0;font-weight: normal;text-align: center;white-space: nowrap;vertical-align: middle;-ms-touch-action: manipulation;touch-action: manipulation;cursor: pointer;background-image: none;border:  1px solid transparent;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;border-radius: 4px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;color: #fff;background-color: #d9534f;float: right">
                <div class="dropzone disable" id="dropzone">
                    <span id="spanfornewfoto" class="spanNone"><?= $widget->label;?></span>
                    <img id="newphoto" src="<?=Yii::$app->getRequest()->getHostInfo()?>/img/<?=$model->image?>">
                </div>
            <?php else: ?>
                <input class="spanNone" type="button" id="deleteimage" onclick="deleteImage(event, this)" value="X" style="margin-bottom: 0;font-weight: normal;text-align: center;white-space: nowrap;vertical-align: middle;-ms-touch-action: manipulation;touch-action: manipulation;cursor: pointer;background-image: none;border:  1px solid transparent;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;border-radius: 4px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;color: #fff;background-color: #d9534f;float: right">
                <div class="dropzone" id="dropzone">
                    <span id="spanfornewfoto"><?= $widget->label;?></span>
                    <img id="newphoto">
                </div>
            <?php endif;?>

    </div>


<?php
    Modal::begin([
        'header'=>'<h4>'.Yii::t('app','Image').'</h4>',
        'id' => 'modal',
        'size' =>'modal-lg'
    ]);
?>
    <?= Html::activeHiddenInput($model, $widget->attribute, ['class' => 'photo-field']); ?>
    <?= Html::hiddenInput('width', $widget->width, ['class' => 'width-input']); ?>
    <?= Html::hiddenInput('height', $widget->height, ['class' => 'height-input']); ?>

    <div class="cropper-buttons">
        <button type="button" class="btn btn-sm btn-success crop-photo hidden" aria-label="<?= Yii::t('cropper', 'CROP_PHOTO');?>">
            <span class="glyphicon glyphicon-scissors" aria-hidden="true"></span> <?= Yii::t('cropper', 'CROP_PHOTO');?>
        </button>
        <button type="button" class="btn btn-sm btn-info upload-new-photo hidden" aria-label="<?= Yii::t('cropper', 'UPLOAD_ANOTHER_PHOTO');?>">
            <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> <?= Yii::t('cropper', 'UPLOAD_ANOTHER_PHOTO');?>
        </button>
    </div>

    <div class="new-photo-area" style="height: <?= $widget->cropAreaHeight; ?>px; width: <?= $widget->cropAreaWidth; ?>px;">
        <div class="cropper-label">
            <span><?= $widget->label;?></span>
        </div>
    </div>
    <div class="progress hidden" style="width: <?= $widget->cropAreaWidth; ?>px;">
        <div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar" style="width: 0%">
            <span class="sr-only"></span>
        </div>
    </div>
<?php
    Modal::end();
?>
</div>

