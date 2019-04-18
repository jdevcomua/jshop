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
        <th colspan="2" class="text-center">Товар</th>
        <th class="text-center">Цена</th>
        <th class="text-center">Количество</th>
        <th class="text-right">Сумма</th>
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
                    <small>Удалить</small>
                </a>
            </td>
            <td data-label="Цена">
                    <span class="h6">
                        <span class="money"><?= $item->cost ?> грн.</span>
                    </span>
            </td>
            <td data-label="Количество">
                <div class="js-qty">
                    <input type="number" class="js-qty__num" value="<?= $model->count ?>"
                           data-id="<?= $item->getId(); ?>" data-type="<?= $item->getType(); ?>">
                </div>
            </td>
            <td data-label="Сумма" class="text-right">
                <span class="h6">
                    <span class="money price-new"><span class="price"><?= $model->count * $item->cost ?></span> грн.</span>
                </span>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="grid__item text-right small--one-whole">
    <p>
        <span class="cart__subtotal-title">Сумма</span>
        <span class="h3 cart__subtotal"><span class="money"><span class="sum"><?= $sum ?></span> грн.</span></span>
    </p>
    <a href="<?= Url::to('/cart/order') ?>" class="btn">Оформить заказ</a>
</div>