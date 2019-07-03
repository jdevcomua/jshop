<?php

use common\models\Item;
use yii\bootstrap\ActiveForm;
use Yii;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\Orders */

?>

<div class="content">
    <br>
    <div class="frame-inside page-product">
        <div class="container">
            <div class="js-empty empty ">
                <div class="f-s_0 title-cart without-crumbs">
                    <div class="frame-title">
                        <h1 class="title"><?php echo \Yii::t('app', 'Оформление заказа'); ?></h1>
                    </div>
                </div>
                <div class="msg layout-highlight layout-highlight-msg">
                    <div class="info">
                        <span class="icon_info"></span>
                        <span class="text-el"><?php echo \Yii::t('app', 'Корзина пуста'); ?></span>
                    </div>
                </div>
            </div>
            <div class="js-no-empty no-empty">
                <div class="f-s_0 title-cart without-crumbs">
                    <div class="frame-title">
                        <h1 class="title"><?php echo \Yii::t('app', 'Оформление заказа'); ?></h1>
                    </div>
                </div>
                <div class="left-cart">
                    <div class="horizontal-form order-form big-title">
                        <?php $form = ActiveForm::begin(); ?>

                        <?php echo $form->field($model, 'name')->input('text', ['style' => 'width:250px;', 'value' => Yii::$app->user->isGuest ? null : $user->surname . ' ' . $user->name])->label(null, ['style' => 'width:160px;float:left;padding-top:3px;']); ?>

                        <?php echo $form->field($model, 'mail')->input('text', ['style' => 'width:250px;', 'value' => Yii::$app->user->isGuest ? null : $user->mail])->label(null, ['style' => 'width:160px;float:left;padding-top:3px;']); ?>

                        <?php echo $form->field($model, 'phone')->input('text', ['style' => 'width:250px;', 'value' => Yii::$app->user->isGuest ? null : $user->phone])->label(null, ['style' => 'width:160px;float:left;padding-top:3px;']); ?>

                        <?php echo $form->field($model, 'address')->input('text', ['style' => 'width:250px;', 'value' => Yii::$app->user->isGuest ? null : $user->address])->label(null, ['style' => 'width:160px;float:left;padding-top:3px;']); ?>

                        <?php echo $form->field($model, 'delivery')->dropDownList(['Самовывоз из магазина' => 'Самовывоз из магазина', 'Новая почта до склада' => 'Новая почта до склада', 'Курьер' => 'Курьер'], ['style' => 'width:250px;border-color: #dfdfdf;padding-left:5px;box-shadow: inset 0 1px 1px #f8f7f7;'])->label(null, ['style' => 'width:160px;float:left;padding-top:3px;']);?>

                        <?php echo $form->field($model, 'payment')->dropDownList(['Оплата наличными' => 'Оплата наличными', 'Безналичный платёж' => 'Безналичный платёж'], ['style' => 'width:250px;border-color: #dfdfdf;padding-left:5px;box-shadow: inset 0 1px 1px #f8f7f7;'])->label(null, ['style' => 'width:160px;float:left;padding-top:3px;']);?>
                        <!--<div class="frame-label" id="frameDelivery">
                            <span class="title"><?php //echo \Yii::t('app', 'Способ доставки'); ?></span>
                            <div class="frame-form-field check-variant-delivery">
                                <div class="frame-radio">
                                    <div class="frame-label">
                                    <span class="niceRadio">

                                    </span>
                                        <div class="name-count">
                                            <span class="text-el p_r"><?php //echo \Yii::t('app', 'Адресная доставка курьером'); ?></span>
                                        </div>
                                    </div>
                                    <div class="frame-label">
                                    <span class="niceRadio">

                                    </span>
                                        <div class="name-count">
                                            <span class="text-el p_r"><?php //echo \Yii::t('app', 'Доставка экспресс службой'); ?></span>
                                        </div>
                                        <div class="help-block">
                                            <?php //echo \Yii::t('app', 'согласно тарифам перевозчиков'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                        <div class="frame-label">
                            <div class="frame-form-field">
                                <button type="button" class="d_l_3 m-b_5 isDrop" data-drop=".hidden-comment"
                                        data-place="inherit" data-overlay-opacity="0"><?php echo \Yii::t('app', 'Добавить комментарий к заказу'); ?>
                                </button>
                                <div class="hidden-comment drop">

                                </div>
                            </div>
                        </div>
                        <div class="frame-label">
                        <span class="frame-form-field">
                            <div class="btn-buy btn-buy-p btn-buy-pp">
                                <input type="submit" value="<?php echo \Yii::t('app', 'Подтвердить заказ'); ?>" id="submitOrder">
                            </div>
                        </span></div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <div class="right-cart">
                    <div class="frame-bask frame-bask-order">
                        <div class="frame-title clearfix">
                            <div class="title f_l"><?php echo \Yii::t('app', 'Мой заказ'); ?></div>
                            <div class="f_r">
                                <a href="<?php echo Yii::$app->urlHelper->to(['cart']) ?>" class="d_l_3 editCart"><?php echo \Yii::t('app', 'Редактировать'); ?></a>
                            </div>
                        </div>

                        <div id="orderDetails" class="p_r">
                            <table class="table-order table-order-view">
                                <tbody>
                                <?php
                                foreach ($models as $model) {
                                    /* @var $model \common\components\CartElement*/
                                    $item = $model->model;
                                    /* @var $item Item */
                                    ?>
                                    <!-- Start. For single product -->
                                    <tr class="items items-bask cart-product">
                                        <td class="frame-items">
                                            <a href="<?php echo Yii::$app->urlHelper->to(['item', 'id' => $item->id]) ?>"
                                               class="frame-photo-title">
                                                <span class="photo-block">
                                                    <span class="helper"></span>
                                                    <img src="<?php echo array_shift($item->getImageUrls()) ?>" alt="">
                                                </span>
                                                <span class="title"><?php echo $item->title ?></span></a></td>
                                        <td>
                                            <div class="frame-frame-count">
                                                <div class="frame-count">
                                                    <span class="plus-minus"><?php echo $model->count ?></span><span
                                                        class="text-el"> шт.</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="frame-cur-sum-price">
                                            <div class="frame-prices f-s_0"><span class="current-prices f-s_0">
                                        <span class="price-new">
                                    <span><span
                                            class="price"><?php echo Yii::$app->cart->getSumForItem($item->id, $item::CART_TYPE); ?></span> грн.</span></span></span>
                                            </div>
                                        </td>
                                    </tr>

                                <?php } ?>
                                </tbody>
                                <tfoot class="gen-info-price">
                                <tr>
                                    <td colspan="3">
                                        <span class="s-t f_l"><?php echo \Yii::t('app', 'Стоимость товаров:'); ?></span>
                                        <div class="f_r"><span>
                                            <span class="price f-w_b"
                                                  style="margin-right: 19px;"><?php echo $sum; ?><span style="font-size: 12px;font-weight: 100;"> грн.</span></span></span>
                                        </div>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="gen-sum-order footer-bask">
                                <div class="inside-padd clearfix">
                                    <span class="title f_l"><?php echo \Yii::t('app', 'Всего к оплате:'); ?></span>
                                    <span class="frame-prices f_r">
                                        <span class="current-prices f-s_0">
                                            <span class="price-new">
                                                <span><span id="finalAmount" class="price"><?php echo $sum; ?></span> грн.
                                                </span></span></span>  </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="h-footer"></div>