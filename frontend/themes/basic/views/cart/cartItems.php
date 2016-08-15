<?php
use common\components\CartAdd;
use common\components\CartElement;
use common\models\Kit;

/* @var $this \yii\web\View */
/* @var $models CartElement[] */
/* @var $sum double */
?>
<div class="cart-items">
    <div class="jspContainer" >
        <div class="inside-padd">
            <table class="table-order">
                <tbody>
                <?php foreach ($models as $model) {
                    /* @var $item CartAdd */
                    $item = $model->model;
                    $kit = ($item->getType() == Kit::CART_TYPE) ? true : false; ?>
                    <tr class="<?= $kit ? 'row-kits' : 'items items-bask cart-product' ?>">
                        <td class="frame-remove-bask-btn">
                            <button type="button" class="icon_times_cart"
                                    onclick="deleteFromCart(<?php echo $item->getId(); ?>, <?php echo $item->getType(); ?>, $(this))">
                            </button>
                        </td>
                        <td class="frame-items <?= $kit ? 'frame-items-kit' : '' ?>">
                            <?php if ($item->getType() == Kit::CART_TYPE) {
                                /* @var $item Kit */
                                $count = 0; ?>
                                <div class="title">Комплект товаров</div>
                                <ul class="items items-bask">
                                    <?php foreach ($item->items as $value) { ?>
                                        <li>
                                            <?php if ($count > 0) { ?>
                                                <div class="next-kit">+</div>
                                            <?php }
                                            echo $this->render('item', ['item' => $value]); ?>
                                        </li>
                                        <?php $count++;
                                    } ?>
                                </ul>
                                <?php
                            } else {
                                echo $this->render('item', ['item' => $item]);
                            } ?>
                        </td>
                        <td class="frame-count frameCount" style="width: 80px;">
                            <div class="number js-number">
                                <input type="number" step="1" min="0"
                                       value="<?php echo $model->count; ?>"
                                       class="plusMinus plus-minus"
                                       id="inputChange-<?php echo $item->getId() ?>"
                                       style="width:50px; border: 1px solid #dfdfdf;padding: 0;height: 31px;"
                                       onchange="changeCountOfItem(<?php echo $item->getId() ?>, $(this))">
                            </div>
                            <span class="s-t f-s_13">шт.</span>
                        </td>
                        <td class="frame-cur-sum-price" style="width: 80px;">
                            <div class="frame-prices f-s_0" style="margin-top:8px;">
                                <span class="current-prices f-s_0">
                                    <span class="price-new">
                                        <span>
                                            <span id="price-<?php echo $item->getId() ?>" class="price">
                                                <?php echo $item->getNewPrice() * $model->count ?>
                                            </span> грн.
                                        </span>
                                    </span>
                                </span>
                            </div>
                        </td>
                    </tr>

                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if (!Yii::$app->cart->isEmpty()) { ?>
        <div class="footer-bask drop-footer">
            <div class="inside-padd">
                <div class="clearfix">
                    <div class="f_r">
                        <span class="c_6 f-s_13">Сумма товаров:</span>
                        <span class="frame-cur-sum-price">
                            <span class="frame-prices f-s_0">
                                <span class="current-prices f-s_0">
                                    <span class="price-new">
                                        <span class="sum price f-w_b" style="display: inline;">
                                            <?php echo $sum ?>
                                        </span> грн.
                                    </span>
                                </span>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="content-frame-foot notCart">
                <div class="clearfix inside-padd">
                    <div class="btn-buy btn-buy-p btn-buy-pp f_r">
                        <a href="<?php echo Yii::$app->urlHelper->to(['cart/order']) ?>">
                            <span class="text-el"><?php echo \Yii::t('app', 'Оформить заказ'); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } else {
        echo "Корзина пуста";
    } ?>
</div>