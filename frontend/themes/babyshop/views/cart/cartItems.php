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
            <td data-label="Товар">
                <a href="<?= $item->getUrl() ?>" class="cart__image">
                    <img src="<?= $item->getOneImageUrl() ?>" alt="<?= $item->getTitle() ?>">
                </a>
            </td>
            <td>
                <a href="<?= $item->getUrl() ?>" class="h6">
                    <?= $item->getTitle() ?>
                </a>

                <br>

                <a href="/cart/change?line=1&amp;quantity=0" class="cart__remove">
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
                    <button type="button" class="js-qty__adjust js-qty__adjust--minus icon-fallback-text" data-id=""
                            data-qty="0">
                        <span class="icon icon-minus" aria-hidden="true"></span>
                        <span class="fallback-text">−</span>
                    </button>
                    <input type="text" class="js-qty__num" value="1" min="1" data-id="" aria-label="quantity"
                           pattern="[0-9]*" name="updates[]" id="updates_19044152835">
                    <button type="button" class="js-qty__adjust js-qty__adjust--plus icon-fallback-text" data-id=""
                            data-qty="11">
                        <span class="icon icon-plus" aria-hidden="true"></span>
                        <span class="fallback-text">+</span>
                    </button>
                </div>
            </td>
            <td data-label="Сумма" class="text-right">
                    <span class="h6">
                        <span class="money"><?= $model->count * $item->cost ?> грн.</span>
                    </span>
            </td>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
<div class="grid__item text-right small--one-whole">
    <p>
        <span class="cart__subtotal-title">Сумма</span>
        <span class="h3 cart__subtotal"><span class="money"><?= $sum ?> грн.</span></span>
    </p>
    <a href="<?= Url::to('/cart') ?>" class="btn">Оформить заказ</a>
</div>
