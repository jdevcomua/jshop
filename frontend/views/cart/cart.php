<?php

use common\models\Item;
use Yii;

?>

<div class="content">
    <br>
    <div class="frame-inside page-product">
        <div class="container">
            <div class="clearfix">
                <div class="right-product">
                    <!--Start. Payments method form -->
                    <div class="frame-delivery-payment">
                        <dl>
                            <dt class="title"><?php echo \Yii::t('app', 'Доставка и оплата'); ?></dt>
                            <dd class="frame-list-delivery">
                                <ul class="list-delivery">
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p1">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el"><?php echo \Yii::t('app', 'Самовывоз'); ?></span><span class="d_b s-t"><?php echo \Yii::t('app', 'Со склада магазина'); ?></span>
                                        </div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p2">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el"><?php echo \Yii::t('app', 'Курьерской службой'); ?> </span><span
                                                class="d_b s-t"><?php echo \Yii::t('app', 'Новая почта и другие'); ?></span></div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p3">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el"><?php echo \Yii::t('app', 'Оплата наличными'); ?></span><span
                                                class="d_b s-t"><?php echo \Yii::t('app', 'Курьеру при получении'); ?></span></div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p4">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el"><?php echo \Yii::t('app', 'Безналичный платеж'); ?></span><span
                                                class="d_b s-t"><?php echo \Yii::t('app', 'Master Card, Visa; Приват 24'); ?></span></div>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                    <div class="frame-delivery-payment">
                        <dl>
                            <dt class="title"><?php echo \Yii::t('app', 'Нужна помощь?'); ?></dt>
                            <dd class="frame-list-delivery"><span class="s-t"><?php echo \Yii::t('app', 'Наши менеджеры ответят на ваши вопросы и помогут с выбором:'); ?></span>
                                <ul class="list-style-1 list-phone-number">
                                    <li class="f-s_15">(093) <span class="d_n">−</span>169-36-98</li>
                                    <li class="f-s_15">(093) <span class="d_n">−</span>169-36-98</li>
                                </ul>
                            </dd>
                        </dl>
                    </div>                    <!--End. Payments method form -->
                    <!-- Start. Similar Products-->
                    <div class="default-frame">
                        <section class="">
                            <div class="default-title">
                                <div class="frame-title">
                                    <div class="title"><?php echo \Yii::t('app', 'Похожие товары'); ?></div>
                                </div><?php echo \Yii::t('app', ''); ?>
                            </div>

                        </section>
                    </div>
                    <!-- End. Similar Products-->
                </div>
                <div>
                    <div class="jspContainer" style="width: 661px;">
                        <div class="inside-padd">
                            <table class="table-order">
                                <tbody>
                                <?php foreach ($models as $model) {
                                    $item = $model->model;
                                    /* @var $item \common\components\CartAdd */
                                    ?>

                                    <tr data-id="17917" class="items items-bask cart-product">
                                        <td class="frame-remove-bask-btn">
                                            <button type="button" class="icon_times_cart" onclick="deleteFromCart(<?php echo $item->getId(); ?>, <?php echo $item->getType(); ?>, $(this))"></button>
                                        </td>
                                        <td class="frame-items">
                                            <a href="<?php echo Yii::$app->urlHelper->to(['item', 'id' => $item->id]) ?>"
                                               class="frame-photo-title">
                                            <span class="photo-block">
                                                <span class="helper"></span>
                                                <img src="<?php echo $item->getImageUrl(); ?>">
                                            </span>
                                                <span class="title"><?php echo $item->title; ?></span>
                                            </a>
                                            <div class="description">
                                            </div>
                                        </td>
                                        <td class="frame-count frameCount" style="width: 80px;">
                                            <div class="number js-number">
                                                <input type="number" step="1" min="0"
                                                       value="<?php echo $model->count; ?>"
                                                       class="plusMinus plus-minus"
                                                       id="inputChange-<?php echo $item->id ?>"
                                                       style="width:50px; border: 1px solid #dfdfdf;padding: 0;height: 31px;"
                                                       onchange="changeCountOfItem(<?php echo $item->id ?>, $(this))">
                                            </div>
                                            <span class="s-t f-s_13">шт.</span>
                                        </td>
                                        <td class="frame-cur-sum-price" style="width: 80px;">
                                            <div class="frame-prices f-s_0" style="margin-top:8px;">
                                                                                        <span
                                                                                            class="current-prices f-s_0">
                                                <span class="price-new">
                                                    <span>
                        <span id="price-<?php echo $item->id ?>" class="price"><?php echo $item->getNewPrice() * $model->count ?></span>
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
                                        <span class="frame-prices f-s_0"><span class="current-prices f-s_0">
                                                <span class="price-new">
                                                    <span class="sum price f-w_b"><?php echo $sum ?></span></span></span></span>
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
                    <?php } else { echo "Корзина пуста";}?>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="h-footer"></div>