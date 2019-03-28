<?php
/* @var $this \yii\web\View */
/* @var $order \common\models\Orders */
/* @var $orderItems \common\models\OrderItem[] */

$this->title = 'Заказ №' . $order->id;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grid">
    <div class="grid__item medium-down--one-whole">
        <h4><?= $this->title ?></h4>

        <p><?= $order->timestamp ?></p>

        <p><strong>Статус заказа:</strong> <?= $order->getStatusTitle() ?></p>
        <p><strong>Статус оплаты: </strong> <?= $order->getPaymentStatusTitle() ?></p>

        <div class="table-wrap">
            <table class="cart-table full table--responsive">
                <thead class="cart__row cart__header-labels">
                <tr>
                    <th colspan="2" class="text-center">Товар</th>
                    <th class="text-center">Цена</th>
                    <th class="text-center">Количество</th>
                    <th class="text-center">Сумма</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orderItems as $orderItem) : ?>
                    <tr class="cart__row table__section">
                        <td data-label="Товар">
                            <a href="<?= $orderItem->item->getUrl() ?>" class="cart__image">
                                <img src="<?= $orderItem->item->getOneImageUrl() ?>"
                                     alt="<?= $orderItem->item->getTitle() ?>">
                            </a>
                        </td>
                        <td>
                            <a href="<?= $orderItem->item->getUrl() ?>" class="h6">
                                <?= $orderItem->item->getTitle() ?>
                            </a>
                        </td>
                        <td class="text-center"><?= $orderItem->sum / $orderItem->count ?> грн.</td>
                        <td class="text-center"><?= $orderItem->count ?></td>
                        <td class="text-center"><?= $orderItem->sum ?> грн.</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5" class="text-right">
                        <strong>Сумма: <?= $order->sum ?> грн.</strong>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
