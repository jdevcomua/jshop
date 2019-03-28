<?php

use common\components\CartAdd;

/* @var $item CartAdd */
/* @var $class string */
?>
<a href="<?php echo Yii::$app->urlHelper->to(['item/item', 'id' => $item->getId()]) ?>"
   class="frame-photo-title">
        <span class="photo-block">
            <span class="helper"></span>
            <img src="<?php echo array_shift($item->getImageUrl()); ?>">
        </span>
    <span class="title"><?php echo $item->getTitle(); ?></span>
</a>
<div class="description">
</div>