<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use zxbodya\yii2\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $seo common\models\Seo */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories array */
?>

<div class="item-form">
    <div style="width: 100%;">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                    'data' => $categories,
                    'options' => ['placeholder' => ''],
                    'theme' => Select2::THEME_DEFAULT,
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>
            <div class="col-md-6" style="">
                <?= $form->field($model, 'barcode')->textInput(['maxlength' => true]); ?>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'active')->checkbox() ?>
                <?= $form->field($model, 'best_seller')->checkbox() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'special')->checkbox() ?>
                <?= $form->field($model, 'deal_week')->checkbox() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'code')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-6">
                <?php echo $form->field($model, 'quantity')->textInput(); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-6">
                <?php echo $form->field($model, 'cost')->textInput(); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'link')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-6">
                <?php echo $form->field($model, 'self_cost')->textInput(); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo $form->field($model, 'metric')
                    ->dropDownList($model->getMetrics(),['prompt' => Yii::t('app','Выберите метрику')]); ?>
            </div>
            <div class="col-md-6">

            </div>
        </div>

        <div class="box-header with-border">
            <h3 class="box-title">Seo</h3>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($seo, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($seo, 'description')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($seo, 'keywords')->textInput(['maxlength' => true])->label('Keywords (comma separated)') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($seo, 'h1')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($seo, 'new_url')->textInput(['maxlength' => true])->label('New URL(Фраза после которая находиться после номера элемента)') ?>
            </div>
            <div class="col-md-6">

            </div>
        </div>

        <?= $form->field($model, 'description')->widget(TinyMce::className(), [
            'options' => ['rows' => 10],
            'language' => 'ru',
            //'compressorRoute' => 'compressor/tinyMceCompressor',
            /*'fileManager' => [
                'class' => TinyMceElFinder::className(),
                'connectorRoute' => 'el-finder/connector',
            ],*/
            //'spellcheckerUrl' => '//speller.yandex.net/services/tinyspell',
            'settings' => [
                'height' => '500',
                'convert_urls' => false,
            ],
        ]); ?>

        <?php $images = [];
        if (!$model->isNewRecord) {
            foreach ($model->getImageUrls() as $url) {
                $images[] = Html::img($url, ['width' => '200px']);
            }
        }
      ?>

           <?= $form->field($model, 'imageFiles')->widget(
               \backend\widget\CropWidget\CropWidget::class, [
               'uploadUrl' => \yii\helpers\Url::toRoute('/item/uploadPhoto'),
               'noPhotoImage' => ($model->isNewRecord) ? '' : $model->getOneImageUrl(),
               'aspectRatio' => '4:4',
               ]);
           ?>

        <div class="form-group"><br>
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), [
                'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                'name' => 'action',
                'value' => 'save'
            ]); ?>
            <?= Html::submitButton(Yii::t('app', 'Редактировать характеристики'), [
                'class' => 'btn btn-info',
                'name' => 'action',
                'value' => 'characteristics'
            ]); ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
<script>

</script>