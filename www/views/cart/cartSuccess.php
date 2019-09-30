<?php
use common\components\CartElement;
use common\models\Item;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $model Item */
/* @var $count double */
?>
<div class="text-center" style="width: 450px; font-size: 15px;line-height: normal;margin-bottom: 15px">
    <p style="font-weight:bold;">
        <?=Yii::t('app','Success add to cart!')?>
    </p>
    <div class="image" style="display: inline-block;">
        <img src="<?=$model->getOneImageUrl()?>"alt="<?= Yii::t('app','Фото') ?>" width="150px">
    </div>
    <div class="cart_success" style="display: inline-block;vertical-align: middle;margin-left: 10px;">
        <p class="product-name"><a data-pjax = 0 href="<?= $model->getUrl() ?>"><?= $model->title ?></a></p>
        <strong><?= $count ?></strong> x
        <span class="price"><?= $model->cost ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
        Итого:<span class="price"><?= $model->cost*$count ?></span>
        <br>
        <br>
        <a href="<?= Url::toRoute('cart/order') ?>" class="btn"><?=Yii::t('app','Checkout')?></a>
    </div>

</div>
