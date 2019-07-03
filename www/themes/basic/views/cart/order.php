<?php

use common\components\CartAdd;
use common\models\Item;
use common\models\Kit;
use yii\bootstrap\ActiveForm;
use Yii;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\Orders */
/* @var $sum double */
/* @var $user \common\models\User */
/* @var $models \common\components\CartElement[] */

$this->title = 'Оформление заказа'; ?>

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

            <?= $form->field($model, 'name')->input('text', ['value' => Yii::$app->user->isGuest ? null : $user->surname . ' ' . $user->name]); ?>

            <?= $form->field($model, 'mail')->input('text', ['value' => Yii::$app->user->isGuest ? null : $user->mail]); ?>

            <?= $form->field($model, 'phone')->input('text', ['value' => Yii::$app->user->isGuest ? null : $user->phone]); ?>

            <?= $form->field($model, 'address')->input('text', ['value' => Yii::$app->user->isGuest ? null : $user->address]); ?>

            <?= $form->field($model, 'delivery')->dropDownList(['Самовывоз из магазина' => 'Самовывоз из магазина',
                'Новая почта до склада' => 'Новая почта до склада', 'Курьер' => 'Курьер']); ?>

            <?= $form->field($model, 'payment')->dropDownList(['Оплата наличными' => 'Оплата наличными',
                'Безналичный платёж' => 'Безналичный платёж']); ?>

            <div class="frame-form-field">
                <button type="button" class="show_comment d_l_3 m-b_5 isDrop">
                    <?php echo \Yii::t('app', 'Добавить комментарий к заказу'); ?>
                </button>
            </div>

            <div class="hidden-comment drop">
                <?= $form->field($model, 'comment')->textarea()->label(''); ?>
            </div>

            <div class="frame-label">
                <span class="frame-form-field">
                    <div class="btn-buy btn-buy-p btn-buy-pp">
                        <input type="submit" value="<?php echo \Yii::t('app', 'Подтвердить заказ'); ?>"
                               id="submitOrder">
                    </div>
                </span>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="right-cart">
        <div class="frame-bask frame-bask-order">
            <div class="frame-title clearfix">
                <div class="title f_l"><?php echo \Yii::t('app', 'Мой заказ'); ?></div>
                <div class="f_r">
                    <a href="<?php echo Yii::$app->urlHelper->to(['cart/index']) ?>"
                       class="d_l_3 editCart"><?php echo \Yii::t('app', 'Редактировать'); ?></a>
                </div>
            </div>

            <div id="orderDetails" class="p_r">
                <table class="table-order table-order-view">
                    <tbody>
                    <?php /* @var $model \common\components\CartElement */
                    foreach ($models as $model) {
                        /* @var $item CartAdd */
                        $item = $model->model;
                        $kit = ($item->getType() == Kit::CART_TYPE) ? true : false; ?>
                        <!-- Start. For single product -->
                        <tr class="<?= $kit ? 'row row-kits' : 'items items-bask cart-product' ?>">
                            <?php if ($kit) { 
                                /* @var $item Kit */
                                $itemsCost = 0;
                                $count = 0; ?>
                                <td class="frame-items frame-items-kit">
                                    <div class="title">Комплект товаров</div>
                                    <ul class="items items-bask">
                                        <?php foreach ($item->items as $value) { ?>
                                            <li>
                                                <?php if ($count > 0) { ?>
                                                    <div class="next-kit">+</div>
                                                <?php } 
                                                $itemsCost = $itemsCost + $value->cost; ?>
                                                <div class="frame-kit">
                                                    <a class="frame-photo-title" href="<?= $value->getUrl(); ?>">
                                                        <span class="photo-block">
                                                            <span class="helper"></span>
                                                            <img src="<?= array_shift($value->getImageUrls()); ?>">
                                                        </span>
                                                        <span class="title"><?= $value->title; ?></span>
                                                    </a>
                                                    <div class="description"></div>
                                                </div>
                                            </li>
                                            <?php $count++;
                                        } ?>
                                    </ul>
                                </td>
                            <?php } else {
                                /* @var $item Item */ ?>
                                <td class="frame-items">
                                    <a href="<?php echo Yii::$app->urlHelper->to(['item', 'id' => $item->id]) ?>"
                                       class="frame-photo-title">
                                        <span class="photo-block">
                                            <span class="helper"></span>
                                            <img src="<?php echo array_shift($item->getImageUrls()) ?>" alt="">
                                        </span>
                                        <span class="title"><?php echo $item->title ?></span>
                                    </a>
                                </td>
                            <?php } ?>
                            <td>
                                <div class="frame-frame-count">
                                    <div class="frame-count">
                                        <span class="plus-minus"><?php echo $model->count ?></span><span
                                            class="text-el"> шт.</span>
                                    </div>
                                </div>
                            </td>

                            <td class="frame-cur-sum-price">
                                <div class="frame-prices f-s_0">
                                    <span class="current-prices f-s_0">
                                        <?php if ($kit || $item->existDiscount()) { ?>
                                            <span class="price-discount">
                                                <span>
                                                    <span class="price">
                                                        <?= $kit ? $model->count*$itemsCost : $model->count*$item->cost ?>
                                                    </span> грн.
                                                </span>
                                            </span>
                                        <?php } ?>
                                        <span class="price-new">
                                            <span>
                                                <span class="price">
                                                    <?= $model->count*$item->cost ?>
                                                </span> грн.
                                            </span>
                                        </span>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot class="gen-info-price">
                    <tr>
                        <td colspan="3">
                            <span class="s-t f_l"><?php echo \Yii::t('app', 'Стоимость товаров:'); ?></span>
                            <div class="f_r">
                                <span>
                                    <span class="price f-w_b" style="margin-right: 19px;">
                                        <?= $sum; ?>
                                        <span style="font-size: 12px;font-weight: 100;"> грн.</span>
                                    </span>
                                </span>
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
                                    <span>
                                        <span id="finalAmount" class="price"><?php echo $sum; ?></span> грн.
                                    </span>
                                </span>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>