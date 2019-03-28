<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $category \common\models\ItemCat */
$this->title = 'Акции';
?>

<?php if (!empty($stocks)) { ?>
    <div class="">
        <ul class="animateListItems items items-catalog  table" id="items-catalog-main">

            <?php
            foreach ($stocks as $stock) {
                /* @var $stock \common\models\Stock */
                ?>
                <li class="globalFrameProduct to-cart" style="height: 210px;width: 20% !important;">
                    <a href="<?php echo Yii::$app->urlHelper->to(['promotion/' . $stock->id]); ?>"
                       class="frame-photo-title">
                                <span class="photo-block"><span class="helper"></span><img
                                        src="<?php echo $stock->getImageUrl(); ?>"></span>
                        <span class="title"
                              style="font-size: 14px; font-weight: bold;"><?php echo $stock->title; ?></span></a>
                    До: <?php echo $stock->date_to; ?>
                    <div class="decor-element"
                         style="height: 210px; width: 100%; position: absolute; right: auto; left: 0px; bottom: auto; top: 0px;">
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
<?php } ?>