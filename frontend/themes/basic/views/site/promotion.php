<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $model \common\models\Stock */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = $model->title;
?>

<?php if ($model->getItems()->count() > 0) { ?>
    <div class="">
        <!-- Start. Category name and count products in category-->
        <div class="f-s_0 title-category">
            <div class="frame-title">
                <h1 class="title"><?php echo $model->title; ?></h1>
            </div>
            <span class="count">До: <?php echo $model->date_to; ?></span>
        </div>
        <br>
        <!-- End. Category name and count products in category-->

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('item', ['value' => $model]);
            },
            'options' => [
                'tag' => 'ul',
                'class' => 'animateListItems items items-catalog table',
                'id' => 'items-catalog-main',
            ],
            'itemOptions' => [
                'tag' => 'li',
                'class' => 'globalFrameProduct to-cart',
                'style' => 'width: 20%!important'
            ],
        ]);?>

    </div>
<?php } ?>