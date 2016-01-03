<?php

use common\models\Item;
use Yii;

echo '<script>';
echo 'var array =';
echo json_encode($itemsCount);
echo ';';
echo '</script>';
?>

<?php echo $this->render('../layouts/menu', ['allCategories' => $allCategories]); ?>

<div class="content">
    <br>
    <div class="frame-inside page-product">
        <div class="container">
            <div class="clearfix">
                <div class="right-product">
                    <!--Start. Payments method form -->
                    <div class="frame-delivery-payment">
                        <dl>
                            <dt class="title">Доставка и оплата</dt>
                            <dd class="frame-list-delivery">
                                <ul class="list-delivery">
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p1">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el">Самовывоз</span><span class="d_b s-t">Со склада магазина</span>
                                        </div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p2">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el">Курьерской службой </span><span
                                                class="d_b s-t">Новая почта и другие</span></div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p3">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el">Оплата наличными</span><span
                                                class="d_b s-t">Курьеру при получении</span></div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p4">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el">Безналичный платеж</span><span
                                                class="d_b s-t">Master Card, Visa; Приват 24</span></div>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                    <div class="frame-delivery-payment">
                        <dl>
                            <dt class="title">Нужна помощь?</dt>
                            <dd class="frame-list-delivery"><span class="s-t">Наши менеджеры ответят на ваши вопросы и помогут с выбором:</span>
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
                                    <div class="title">Похожие товары</div>
                                </div>
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
                                <?php foreach ($items as $item) {
                                    /* @var $item Item */
                                    ?>

                                    <tr data-id="17917" class="items items-bask cart-product">
                                        <td class="frame-remove-bask-btn">
                                            <button type="button" class="icon_times_cart" onclick="
                                                var $thisitem = $(this);
                                                $.ajax({
                                                url: 'cart/delete',
                                                async: false,
                                                data: { item_id: '<?php echo $item->id ?>'},
                                                dataType: 'text',
                                                success: function(data){
                                                $thisitem.parent().parent().remove();
                                                var obj = eval(data);
                                                $('.sum').html(obj.sumAll);
                                                $('#countItems ').html(obj.countAll);
                                                if (obj.countAll == 0) {
                                                $('#cartFull').toggleClass('d_n');
                                                $('#cartEmpty').toggleClass('d_n');
                                                }
                                                }
                                                });"></button>
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
                                                       value="<?php echo $itemsCount[$item->id]; ?>"
                                                       class="plusMinus plus-minus"
                                                       id="inputChange-<?php echo $item->id ?>"
                                                       style="width:50px; border: 1px solid #dfdfdf;padding: 0;height: 31px;"
                                                       onchange="
                                                           var $thisItem = $(this);
                                                           if ($(this).val() < 0) {
                                                           $(this).val(array[$(this).attr('id').split('-')[1]]);
                                                           alert('Значение должно быть больше или равно 0');
                                                           } else if ($(this).val() == 0) {
                                                           $.ajax({
                                                           url: 'cart/delete',
                                                           async: false,
                                                           data: { item_id: '<?php echo $item->id ?>'},
                                                           dataType: 'text',
                                                           success: function(data){
                                                           var obj = eval(data);
                                                           $('.sum').html(obj.sumAll);
                                                           $('#countItems ').html(obj.countAll);
                                                           $thisItem.parent().parent().parent().remove();
                                                           }
                                                           });
                                                           } else {
                                                           if ($(this).val() > array[$(this).attr('id').split('-')[1]]) {
                                                           var toChange = $(this).val() - array[$(this).attr('id').split('-')[1]];
                                                           $.ajax({
                                                           url: 'cart/add',
                                                           async: false,
                                                           data: { item_id: '<?php echo $item->id ?>', count: toChange},
                                                           dataType: 'text',
                                                           success: function(data){
                                                           var obj = eval(data);
                                                           $('.sum').html(obj.sumAll);
                                                           $('#price-' + $thisItem.attr('id').split('-')[1]).html(obj.sumItem);
                                                           $thisItem.val(obj.countItem);
                                                           array[$thisItem.attr('id').split('-')[1]] = obj.countItem;
                                                           $('#countItems ').html(obj.countAll);
                                                           }
                                                           });
                                                           } else if ($(this).val() < array[$(this).attr('id').split('-')[1]]) {
                                                           var toChange = array[$(this).attr('id').split('-')[1]] - $(this).val();
                                                           $.ajax({
                                                           url: 'cart/delete',
                                                           async: false,
                                                           data: { item_id: '<?php echo $item->id ?>', count: toChange},
                                                           dataType: 'text',
                                                           success: function(data){
                                                           var obj = eval(data);
                                                           $('.sum').html(obj.sumAll);
                                                           $('#price-' + $thisItem.attr('id').split('-')[1]).html(obj.sumItem);
                                                           $thisItem.val(obj.countItem);
                                                           array[$thisItem.attr('id').split('-')[1]] = obj.countItem;
                                                           $('#countItems ').html(obj.countAll);
                                                           if (obj.countAll == 0) {
                                                           $('#cartFull').toggleClass('d_n');
                                                           $('#cartEmpty').toggleClass('d_n');
                                                           }
                                                           }
                                                           });
                                                           }
                                                           }
                                                           ">
                                            </div>
                                            <span class="s-t f-s_13">шт.</span>
                                        </td>
                                        <td class="frame-cur-sum-price" style="width: 80px;">
                                            <div class="frame-prices f-s_0" style="margin-top:8px;">
                                                                                        <span
                                                                                            class="current-prices f-s_0">
                                                <span class="price-new">
                                                    <span>
<span id="price-<?php echo $item->id ?>" class="price"><?php echo $item->cost * $itemsCount[$item->id] ?></span>
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
                                        <span class="text-el">Оформить заказ</span>
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