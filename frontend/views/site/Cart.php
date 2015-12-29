<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\OrderItem;
use common\models\Item;

?>

<?php echo $this->render('menu', ['allCategories' => $allCategories]); ?>

<div class="content">
    <br>
    <div class="frame-inside page-product">
        <div class="container">
            <div class="clearfix">
                <div class="f-s_0 title-product">
                    <!-- Start. Name product -->
                </div>
                <div class="right-product">
                    <!--Start. Payments method form -->
                    <div class="frame-delivery-payment"><dl><dt class="title">Доставка и оплата</dt><dd class="frame-list-delivery">
                                <ul class="list-delivery">
                                    <li class="f-s_0"><span class="frame-ico"><span class="icon_d_p1">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el">Самовывоз</span><span class="d_b s-t">Со склада магазина</span></div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span class="icon_d_p2">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el">Курьерской службой </span><span class="d_b s-t">Новая почта и другие</span></div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span class="icon_d_p3">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el">Оплата наличными</span><span class="d_b s-t">Курьеру при получении</span></div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span class="icon_d_p4">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el">Безналичный платеж</span><span class="d_b s-t">Master Card, Visa; Приват 24</span></div>
                                    </li>
                                </ul>
                            </dd></dl></div>
                    <div class="frame-delivery-payment"><dl><dt class="title">Нужна помощь?</dt><dd class="frame-list-delivery"><span class="s-t">Наши менеджеры ответят на ваши вопросы и помогут с выбором:</span>
                                <ul class="list-style-1 list-phone-number">
                                    <li class="f-s_15">(093) <span class="d_n">−</span>169-36-98</li>
                                    <li class="f-s_15">(093) <span class="d_n">−</span>169-36-98</li>
                                </ul>
                            </dd></dl></div>                    <!--End. Payments method form -->
                    <!-- Start. Similar Products-->
                    <div class="default-frame">
                        <section class="">
                            <div class="default-title">
                                <div class="frame-title">
                                    <div class="title">Похожие товары</div>
                                </div>
                            </div>

                        </section>
                    </div>
                    <!-- End. Similar Products-->
                </div>

                <div class="left-product leftProduct">

                    <div class="frame-bask frameBask p_r">
                        <div class="drop-content" style="overflow: hidden; padding: 0px; height: 395px; width: 661px;"><div class="jspContainer" style="width: 661px; height: 395px;"><div class="jspPane" style="padding: 0px; top: 0px; width: 661px;"><div class="inside-padd">
                                        <table class="table-order">
                                            <tbody>
                                            <?php foreach ($items as $item) {
                                                /* @var $item Item*/
                                                ?>

                                            <tr data-id="17917" class="items items-bask cart-product">
                                                <td class="frame-remove-bask-btn">
                                                    <button type="button" class="icon_times_cart"></button>
                                                </td>
                                                <td class="frame-items">
                                                    <a href="http://active.imagecmsdemo.net/shop/product/velosipednyi-shlem-uvex-i-vo-cc-0420uvx-09" title="" class="frame-photo-title">
                                            <span class="photo-block">
                                                <span class="helper"></span>
                                                <img src="<?php echo $item->getImageUrl(); ?>">
                                            </span>
                                                        <span class="title"><?php echo $item->title; ?></span>
                                                    </a>
                                                    <div class="description">
                                                    </div>
                                                </td>
                                                <td class="frame-count frameCount">
                                                    <div class="number js-number" data-title="Количество на складе 1">
                                                        <input type="text" value="<?php echo $itemsCount[$item->id]; ?>" class="plusMinus plus-minus" id="inputChange17917" data-id="17917" data-title="Только цифры" data-min="1" data-max="1">
                                                    </div>
                                                    <span class="s-t f-s_13">шт.</span>
                                                </td>
                                                <td class="frame-cur-sum-price">
                                                    <div class="frame-prices f-s_0">
                                                                                        <span class="current-prices f-s_0">
                                                <span class="price-new">
                                                    <span>
<span class="price"><?php echo $item->cost*$itemsCount[$item->id]?></span>
                                                    </span>
                                                </span>
                                                                                            </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div></div></div></div>
                        <div class="footer-bask drop-footer">
                            <div class="inside-padd">
                                <div class="clearfix">
                                    <div class="f_r">
                                        <span class="c_6 f-s_13">Сумма товаров:</span>
                        <span class="frame-cur-sum-price">
                            <span class="frame-prices f-s_0"><span class="current-prices f-s_0">
                                    <span class="price-new">
<span class="price f-w_b"><?php echo $sum?></span></span></span></span>
                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="content-frame-foot notCart">
                                <div class="clearfix inside-padd">
                                    <div class="btn-buy btn-buy-p btn-buy-pp f_r">
                                        <a href="http://active.imagecmsdemo.net/shop/cart">
                                            <span class="text-el">Оформить заказ</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="http://active.imagecmsdemo.net/templates/active/js/cusel-min-2.5.js"></script>                </div>
<div class="h-footer"></div>