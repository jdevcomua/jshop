<?php

use common\components\CartAdd;
use common\components\CartElement;
use common\models\Kit;
use Yii;

/* @var $this \yii\web\View */
/* @var $models CartElement[] */
/* @var $sum double */
$this->title = 'Корзина';
?>
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
                            <div class="descr"><span
                                    class="text-el"><?php echo \Yii::t('app', 'Самовывоз'); ?></span><span
                                    class="d_b s-t"><?php echo \Yii::t('app', 'Со склада магазина'); ?></span>
                            </div>
                        </li>
                        <li class="f-s_0"><span class="frame-ico"><span
                                    class="icon_d_p2">&nbsp;</span></span>
                            <div class="descr"><span
                                    class="text-el"><?php echo \Yii::t('app', 'Курьерской службой'); ?> </span><span
                                    class="d_b s-t"><?php echo \Yii::t('app', 'Новая почта и другие'); ?></span>
                            </div>
                        </li>
                        <li class="f-s_0"><span class="frame-ico"><span
                                    class="icon_d_p3">&nbsp;</span></span>
                            <div class="descr"><span
                                    class="text-el"><?php echo \Yii::t('app', 'Оплата наличными'); ?></span><span
                                    class="d_b s-t"><?php echo \Yii::t('app', 'Курьеру при получении'); ?></span>
                            </div>
                        </li>
                        <li class="f-s_0"><span class="frame-ico"><span
                                    class="icon_d_p4">&nbsp;</span></span>
                            <div class="descr"><span
                                    class="text-el"><?php echo \Yii::t('app', 'Безналичный платеж'); ?></span><span
                                    class="d_b s-t"><?php echo \Yii::t('app', 'Master Card, Visa; Приват 24'); ?></span>
                            </div>
                        </li>
                    </ul>
                </dd>
            </dl>
        </div>
        <div class="frame-delivery-payment">
            <dl>
                <dt class="title"><?php echo \Yii::t('app', 'Нужна помощь?'); ?></dt>
                <dd class="frame-list-delivery"><span
                        class="s-t"><?php echo \Yii::t('app', 'Наши менеджеры ответят на ваши вопросы и помогут с выбором:'); ?></span>
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
    <?= $this->render('cartItems', [
        'models' => $models, 'sum' => $sum
    ]) ?>
</div>