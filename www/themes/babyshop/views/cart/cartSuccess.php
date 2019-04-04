<?php
use common\components\CartElement;
use common\models\Item;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $model Item */
/* @var $count double */
?>
<div class="text-center">
    <p>
        Success add to cart!
    </p>
    <p class="product-name"><a data-pjax = 0 href="<?= $model->getUrl() ?>"><?= $model->title ?></a></p>
    <strong><?= $count ?></strong> x <span class="price"><?= $model->cost ?></span>

    <a href="<?= Url::toRoute('cart/order') ?>" class="btn">Checkout</a>
</div>
