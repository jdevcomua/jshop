<?php
use common\components\CartElement;
use common\models\Item;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $models CartElement[] */
/* @var $sum double */
?>
<table class="cart-table full table--responsive">
    <thead class="cart__row cart__header-labels">
    <tr>
        <th colspan="2" class="text-center"><?=Yii::t('app','Product')?></th>
        <th class="text-center"><?=Yii::t('app','Price')?></th>
        <th class="text-center"><?=Yii::t('app','Number')?></th>
        <th class="text-right"><?=Yii::t('app','Amount')?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($models as $model) :
        /* @var $item Item */
        $item = $model->getModel(); ?>
        <tr class="cart__row table__section">
            <td>
                <a href="<?= $item->getUrl() ?>" class="h6">
                    <?= $item->getTitle() ?>
                </a>

                <br>

                <a href="" class="cart__remove" data-id="<?= $item->getId(); ?>" data-type="<?= $item->getType(); ?>">
                    <small><?=Yii::t('app','Delete')?></small>
                </a>
            </td>
            <td data-label="Price">
                    <span class="h6">
                        <span class="money"><?= $item->cost ?> <?=Yii::t('app','UAH')?></span>
                    </span>
            </td>
            <td data-label="Number">
                <div class="js-qty">
                    <input type="number" class="js-qty__num" value="<?= $model->count ?>"
                           data-id="<?= $item->getId(); ?>" data-type="<?= $item->getType(); ?>">
                </div>
            </td>
            <td data-label="Amount" class="text-right">
                <span class="h6">
                    <span class="money price-new"><span class="price"><?= $model->count * $item->cost ?></span> <?=Yii::t('app','UAH')?></span>
                </span>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="grid__item text-right small--one-whole">
    <p>
        <span class="cart__subtotal-title"><?=Yii::t('app','Amount')?></span>
        <span class="h3 cart__subtotal"><span class="money"><span class="sum"><?= $sum ?></span> <?=Yii::t('app','UAH')?></span></span>
    </p>
    <a href="<?= Url::to('/cart/order') ?>" class="btn"><?=Yii::t('app','Checkout')?></a>
</div>
