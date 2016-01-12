<?php

use common\models\OrderItem;
use Yii;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\Orders */

?>

<div class="content">
    <br>
    <div class="frame-inside page-product">
        <div class="container">
            <div class="f-s_0 without-crumbs">
                <div class="frame-title">
                </div>
            </div>
            <div class="f-s_0 title-order-view without-crumbs">
                <div class="frame-title">
                    <h1 class="title"><?php echo \Yii::t('app', 'Заказ'); ?> №:<span class="number-order"><?php echo $order->id; ?></span></h1>
                </div>
            </div>

            <!-- Start. Displays a information block about Order -->
            <div class="left-order">
                <!--                Start. User info block-->
                <table class="table-info-order" style="font-size: 13px;">
                    <colgroup>
                        <col width="150">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th style="padding-bottom: 10px;"><?php echo \Yii::t('app', 'Имя получателя:'); ?></th>
                        <td><?php echo $order->name; ?></td>
                    </tr>

                    <tr>
                        <th style="padding-bottom: 10px;">E-mail:</th>
                        <td><?php echo $order->mail; ?></td>
                    </tr>
                    <tr>
                        <th style="padding-bottom: 10px;"><?php echo \Yii::t('app', 'Телефон'); ?>:</th>
                        <td><?php echo $order->phone; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo \Yii::t('app', 'Адрес'); ?>:</th>
                        <td><?php echo $order->address; ?></td>
                    </tr>
                    <!--                End. User info block-->
                    <tr>
                        <td colspan="2">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo \Yii::t('app', 'Дата заказа:'); ?></th>
                        <td><?php echo $order->timestamp; ?></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <hr>
                        </td>
                    </tr>
                    <!-- Start. Delivery Method name -->
                    <tr>
                        <th style="padding-bottom: 10px;"><?php echo \Yii::t('app', 'Способ доставки'); ?>:</th>
                        <td>
                            <?php echo $order->delivery; ?>
                        </td>
                    </tr>
                    <!-- End. Delivery Method name -->
                    <!-- Start. Render payment button and payment description -->
                    <tr>
                        <th style="padding-bottom: 10px;"><?php echo \Yii::t('app', 'Способ оплаты'); ?>:</th>
                        <td>
                            <?php echo $order->payment ?>
                        </td>
                    </tr>
                    <!--                Start. Order status-->
                    <tr>
                        <th><?php echo \Yii::t('app', 'Статус оплаты'); ?>:</th>
                        <td>
                            <span class="status-pay <?php echo ($order->payment_status == 'Не оплачен') ? 'not-paid' : 'paid'; ?>"><?php echo $order->payment_status; ?></span>
                        </td>
                    </tr>
                    <!--                End. Order status-->
                    <tr>
                        <td></td>
                        <td>
                            <div class="frame-payment">
                            </div>
                        </td>
                    </tr>
                    <!-- End. Render payment button and payment description -->
                    </tbody>
                </table>
            </div>
            <!-- End. Displays a information block about Order -->
            <div class="right-order">
                <div class="frame-bask frame-bask-order">
                    <div class="frame-bask-scroll">
                        <div class="inside-padd">
                            <table class="table-order table-order-view">
                                <colgroup>
                                    <col>
                                    <col width="120">
                                </colgroup>
                                <tbody>

                                <?php
                                foreach ($orderItems as $orderItem) {
                                    /* @var $orderItem OrderItem */
                                    ?>

                                    <tr class="items items-bask items-order cart-product">
                                        <td class="frame-items">
                                            <!-- Start. Render Ordered Products -->
                                            <a href="<?php echo Yii::$app->urlHelper->to(['item', 'id' => $orderItem->item->id]) ?>"
                                               class="frame-photo-title">
                                        <span class="photo-block">
                                            <span class="helper"></span>
                                            <img src="<?php echo $orderItem->item->getImageUrl() ?>" alt="">
                                        </span>
                                                <span class="title"><?php echo $orderItem->item->title ?></span></a>
                                        </td>
                                        <td><span class="plus-minus"><?php echo $orderItem->count ?></span><span
                                                class="text-el"> шт.</span></td>
                                        <td class="frame-cur-sum-price">
                                    <span class="frame-prices">
                                        <span class="current-prices f-s_0"><span class="price-new"><span
                                                    class="price"><?php echo $orderItem->sum; ?></span></span> </span>
                                    </span>

                                        </td>
                                    </tr>

                                <?php } ?>

                                </tbody>
                                <tfoot class="gen-info-price">
                                <tr>
                                    <td colspan="3">
                                        <span class="s-t f_l"><?php echo \Yii::t('app', 'Стоимость товаров:'); ?></span>
                                        <div class="frame-cur-sum-price f_r">
                                <span class="price-new">
                                    <span>
                                        <span class="price"
                                              style="margin-right: 19px;"><?php echo $order->sum; ?></span>
                                    </span>
                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <span class="s-t f_l"><?php echo \Yii::t('app', 'Доставка:'); ?></span>
                                        <div class="f_r">
                                            <span class="text-el s-t"><?php echo \Yii::t('app', 'согласно тарифам перевозчиков'); ?></span>
                                        </div>
                                    </td>
                                </tr>
                                </tfoot>

                                <!-- End. Render Ordered kit products  -->

                            </table>
                        </div>
                    </div>
                    <div class="footer-bask">
                        <div class="inside-padd">
                            <!-- Start. Price block-->
                            <div class="gen-sum-order clearfix">
                                <span class="title f_l"><?php echo \Yii::t('app', 'Всего к оплате:'); ?></span>
                                <span class="frame-prices f-s_0 f_r">
                                    <span class="current-prices f-s_0">
                                        <span class="price-new">
                                            <span>
                                                <span class="price"><?php echo $order->sum; ?></span>
                                            </span>
                                        </span>
                                    </span>
                                </span>
                            </div>
                            <!-- End. Price block-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="h-footer"></div>