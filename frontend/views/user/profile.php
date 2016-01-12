<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\User */

use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Orders;

?>

<div class="content">
    <br>
    <div class="frame-inside page-product">
        <div class="container">
            <div class="f-s_0 title-profile without-crumbs">
                <div class="frame-title">
                    <h1 class="title">umo4ka, <?php echo \Yii::t('app', 'Добро пожаловать!'); ?></h1>
                </div>
            </div>
            <div class="left-personal f-s_0">
                <ul class="tabs tabs-data">
                    <li class="active" onclick="tabMyData()">
                        <button ><?php echo \Yii::t('app', 'Основные данные'); ?>
                        </button>
                    </li>
                    <li class="" onclick="tabChangePassword()">
                        <button><?php echo \Yii::t('app', 'Изменить пароль'); ?>
                        </button>
                    </li>
                    <li class="" onclick="tabOrderHistory()">
                        <button><?php echo \Yii::t('app', 'История заказа'); ?>
                        </button>
                    </li>
                    <li id="wish" class="" onclick="tabWishList()">
                        <button><?php echo \Yii::t('app', 'Список желаний'); ?>
                        </button>
                    </li>
                </ul>
                <div class="frame-tabs-ref frame-tabs-profile">
                    <div id="my_data" style="display: block;" class="visited activeTab">
                        <div class="inside-padd clearfix">
                            <div class="frame-change-profile">
                                <?php $form = ActiveForm::begin(); ?>
                                <div class="horizontal-form">
                                    <?php echo $form->field($model, 'username')->input('text', ['style' => 'width:250px;'])->label(null, ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

                                    <?php echo $form->field($model, 'mail')->input('text', ['style' => 'width:250px;'])->label(null, ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

                                    <?php echo $form->field($model, 'name')->input('text', ['style' => 'width:250px;'])->label(null, ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

                                    <?php echo $form->field($model, 'surname')->input('text', ['style' => 'width:250px;'])->label(null, ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

                                    <?php echo $form->field($model, 'phone')->input('text', ['style' => 'width:250px;'])->label(null, ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

                                    <?php echo $form->field($model, 'address')->input('text', ['style' => 'width:250px;'])->label(null, ['style' => 'width:100px;float:left;padding-top:3px;']); ?>

                                    <div class="frame-label">
                                        <span class="title">&nbsp;</span>
                                        <div class="frame-form-field">
                                            <div class="btn-form m-b_15">
                                                <?php echo Html::submitButton('<span class="text-el" style="color:#fff">' . Yii::t('app', 'Сохранить') . '</span>', ['style' => 'background: #34a4e7;', 'name' => 'login-button']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                    <div id="change_pass" style="display: block;" class="d_n">
                        <div class="inside-padd">
                            <div class="frame-change-password">
                                <div class="horizontal-form big-title">
                                    <?php $form = ActiveForm::begin(); ?>
                                    <label>
                                        <span class="title"><?php echo \Yii::t('app', 'Старый пароль'); ?>:</span>
                                            <span class="frame-form-field">
                                                <input type="password" name="old_password" style="width:250px;">
                                            </span>
                                    </label>
                                    <label>
                                        <span class="title"><?php echo \Yii::t('app', 'Новый пароль'); ?>:</span>
                                            <span class="frame-form-field">
                                                <input type="password" name="new_password" style="width:250px;">
                                            </span>
                                    </label>
                                    <label>
                                        <span class="title"><?php echo \Yii::t('app', 'Повторите пароль'); ?>:</span>
                                            <span class="frame-form-field">
                                                <input type="password" name="confirm_new_password" style="width:250px;">
                                            </span>
                                    </label>
                                    <div class="frame-label">
                                        <span class="title">&nbsp;</span>
                                            <span class="frame-form-field">
                                                <span class="btn-form">
                                                    <input type="submit"
                                                           value="<?php echo \Yii::t('app', 'Изменить пароль'); ?>">
                                                </span>
                                            </span>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="history_order" style="display: block;" class="d_n">
                        <div class="inside-padd">
                            <table class="table-profile" style="font-size: 13px">
                                <thead>
                                <tr>
                                    <th><?php echo \Yii::t('app', 'Заказ'); ?> #</th>
                                    <th><?php echo \Yii::t('app', 'Время покупки'); ?></th>
                                    <th><?php echo \Yii::t('app', 'Сумма покупки'); ?></th>
                                    <th><?php echo \Yii::t('app', 'Статус заказа'); ?></th>
                                    <th><?php echo \Yii::t('app', 'Статус платежа'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($model->orders as $order) {
                                    /* @var $order Orders */
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo Yii::$app->urlHelper->to(['cart/order', 'id' => $order->id]); ?>">
                                                <?php echo \Yii::t('app', 'Заказ'); ?> #<?php echo $order->id; ?></a>
                                        </td>
                                        <td><?php echo $order->timestamp; ?></td>
                                        <td>
                                            <div class="frame-prices">
                                                <span class="current-prices">
                                                    <span class="price-new">
                                                        <span>
                                                            <span class="price"><?php echo $order->sum; ?></span>
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                        </td>
                                        <td><?php echo $order->order_status; ?></td>
                                        <td><?php echo $order->payment_status; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="wish_list" style="display: block;" class="d_n">
                        <div class="inside-padd">
                            <div class="clearfix frame-tabs-ref">
                                <div id="list-products" style="display: block;">
                                    <div style="margin-bottom: 17px;">
                                        <div class="btn-buy">
                                            <button type="button" class="isDrop" onclick="$('.drop-add-wishlist').toggleClass('d_n')">
                                                <span class="icon_add_wish"></span>
                                                <span class="text-el">Создать новый список</span>
                                            </button>
                                        </div>
                                        <span class="help-block">В список избранных вы можете отложить понравившиеся товары, также показать список друзьям</span>
                                    </div>
                                    <div class="drop drop-style-2 d_n drop-add-wishlist active inherit" style="display: block; z-index: 1104;">
                                        <div class="drop-header">
                                            <div class="title">Создание списка желаний</div>
                                        </div>
                                        <div class="drop-content2">
                                            <div class="inside-padd">
                                                <div class="horizontal-form big-title">
                                                    <?php $form = ActiveForm::begin(); ?>
                                                        <?php echo $form->field(new \common\models\WishList(), 'title')->textInput(['style' => 'width: 300px;'])->label("Название списка:", ['style' => 'width: 160px;float:left;']); ?>
                                                        <!--<label>
                                                            <span class="title">Описание:</span>
                                                            <span class="frame-form-field">
                                                                <textarea name="wlDescription"></textarea>
                                                            </span>
                                                        </label>-->
                                                        <div class="frame-label" style="margin-bottom: 0;">
                                                            <div class="frame-form-field" style="margin-left: 160px; margin-top: 10px;">
                                                                <div class="btn-def">
                                                                    <?php echo Html::submitButton('<span class="text-el">' . Yii::t('app', 'Создать новый список') . '</span>>', ['class' => 'btn-search', 'style' => 'width: 180px;']) ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php ActiveForm::end(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php foreach ($model->getWishLists()->all() as $list) {
                                        /* @var $list \common\models\WishList*/
                                        ?>
                                        <div id="list-<?php echo $list->id ?>" class="drop-style-2 drop-wishlist-items" data-rel="list-item">
                                            <div class="drop-header2">
                                                <h2><?php echo $list->title; ?></h2>
                                            </div>
                                            <div class="drop-content2">
                                                <div class="inside-padd">
                                                    <ul style="font-size: 12px; margin-left: 0; " class="items items-catalog items-wish-list">
                                                        <?php
                                                        if (empty($list->getWishes()->all())) { ?>
                                                            Список пуст
                                                        <?php } else {
                                                        foreach ($list->getWishes()->all() as $wish) {
                                                            /* @var $wish \common\models\Wish*/
                                                            $item = $wish->item;
                                                            ?>
                                                        <li id="wish-<?php echo $wish->id; ?>" class="globalFrameProduct to-cart" data-pos="top">
                                                            <!-- Start. Photo & Name product -->
                                                            <a href="<?php echo Yii::$app->urlHelper->to(['item','id'=>$item->id]);?>"
                                                               class="frame-photo-title">
                                                                <span class="photo-block">
                                                                    <span class="helper"></span>
                                                                    <img src="<?php echo $item->getImageUrl(); ?>"></span>
                                                            <span class="title"><?php echo $item->title; ?></span>
                                                            </a>
                                                            <!-- End. Photo & Name product -->
                                                            <div class="description">
                                                                <div class="left-description">
                                                                    <div class="frame-star f-s_0">
                                                                        <div class="star">
                                                                            <div id="star_rating_17214"
                                                                                 class="productRate star-small">
                                                                                <div style="width: 100%"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End. Collect information about Variants, for future processing -->
                                                                </div>
                                                                <div class="frame-prices-buttons">
                                                                    <!-- Start. Prices-->
                                                                    <div class="frame-prices f-s_0">
                                                                        <!-- Start. Product price-->
                                                                    <span class="current-prices f-s_0">
                                                                        <span class="price-new">
                                                                            <span><span
                                                                                    class="price priceVariant"><?php echo $item->cost; ?></span></span>
                                                                        </span>
                                                                    </span>
                                                                        <!-- End. Product price-->
                                                                    </div>
                                                                    <!-- End. Prices-->
                                                                    <div class="f-s_0 m-b_10">
                                                                        <div class="funcs-buttons">
                                                                            <!-- Start. Collect information about Variants, for future processing -->
                                                                            <div class="frame-count-buy js-variant-17906 js-variant">
                                                                                <?php if (Yii::$app->cart->checkItemInCart($item->id)) { ?>
                                                                                    <div id="inCart-<?php echo $item->id ?>" class="btn-buy btn-cart">
                                                                                        <a href="<?php echo Yii::$app->urlHelper->to(['cart']) ?>"
                                                                                           style="padding: 0 9px 0 7px;">
                                                                                            <button type="button" class="btnBuy"
                                                                                                    style="padding-top: 8px;">
                                                                                                <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                                                <span class="text-el">В корзине</span>
                                                                                            </button>
                                                                                        </a>
                                                                                    </div>
                                                                                <?php } else { ?>
                                                                                    <div id="inCart-<?php echo $item->id ?>"
                                                                                         class="btn-buy btn-cart d_n">
                                                                                        <a href="<?php echo Yii::$app->urlHelper->to(['cart']) ?>"
                                                                                           style="padding: 0 9px 0 7px;">
                                                                                            <button type="button" class="btnBuy"
                                                                                                    style="padding-top: 8px;">
                                                                                                <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                                                <span class="text-el">В корзине</span>
                                                                                            </button>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div id="toCart-<?php echo $item->id ?>" class="btn-buy">
                                                                                        <button type="button" class="btnBuy infoBut" onclick="addToCart(<?php echo $item->id ?>)">
                                                                                            <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                                            <span class="text-el">Купить</span>
                                                                                        </button>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </div>

                                                                        </div>
                                                                        <!-- End. Collect information about Variants, for future processing -->
                                                                        <!-- Wish List & Compare List buttons -->
                                                                        <div class="frame-wish-compare-list f-s_0">
                                                                            <div class="frame-btn-comp">
                                                                                <!-- Start. Compare List button -->
                                                                                <div class="btn-compare">
                                                                                    <button class="toCompare" data-id="17205" type="button"
                                                                                            data-firtitle="В список сравнений"
                                                                                            data-sectitle="В списке сравнений"
                                                                                            data-title="В список сравнений" data-rel="tooltip">
                                                                                        <span class="icon_compare"></span>
                                                                                        <span class="text-el d_l">В список сравнений</span>
                                                                                    </button>
                                                                                </div>
                                                                                <!-- End. Compare List button -->
                                                                            </div>
                                                                        </div>
                                                                        <!-- End. Wish List & Compare List buttons -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Start. Remove buttons if compare-->
                                                            <!-- End. Remove buttons if compare-->

                                                            <!-- Start. For wishlist page-->
                                                            <div class="funcs-buttons-WL-item">
                                                                <div class="btn-remove-item-wl">
                                                                    <button type="button" id="remove-<?php echo $wish->id?>"
                                                                            class="btnRemoveItem isDrop" onclick="removeItemFromWishList(<?php echo $wish->id ?>)"><span class="icon_remove"></span>
                                                                        <span class="text-el d_l_1">Удалить</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- End. For wishlist page-->
                                                            <div class="decor-element"></div>
                                                        </li>
                                                        <?php } } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="drop-footer2">
                                                <div class="inside-padd">
                                                    <div class="funcs-buttons-wishlist d_i-b">
                                                        <div class="btn-edit-WL">
                                                            <button type="button" class="isDrop" onclick="
                                                            $('#forCenter').toggleClass('d_n');
                                                            $('#wishListId').val($(this).parent().parent().parent().parent().parent().attr('id').split('-')[1]);
                                                            ">
                                                                <span class="d_l_1 text-el">Редактировать список</span>
                                                            </button>
                                                        </div>
                                                        <div class="btn-remove-WL">
                                                            <button type="button" class="isDrop" onclick="removeWishList(<?php echo $list->id ?>)">
                                                                <span class="icon_remove"></span>
                                                                <span class="text-el d_l_1">Удалить список</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="d_i-b">
                                                        <script type="text/javascript"
                                                                src="http://yandex.st/share/share.js"
                                                                charset="utf-8"></script>
                                                        <div class="yashare-auto-init" data-yasharel10n="ru"
                                                             data-yasharelink="http://frontend.dev<?php echo Yii::$app->urlHelper->to(['user/wishlist', 'id' => '9']);?>"
                                                             data-yasharetype="none" data-yashareTitle="Мой список желаний"
                                                             data-yashareDescription='Хочу купить в "active"'
                                                             data-yashareImage="http://s017.radikal.ru/i421/1601/46/57881a3ba8e9.jpg"
                                                             data-yasharequickservices="vkontakte,facebook,odnoklassniki,gplus,">
                                                        <span class="b-share"><a rel="nofollow" target="_blank"
                                                                                 title="ВКонтакте"
                                                                                 class="b-share__handle b-share__link b-share-btn__vkontakte"
                                                                                 href="https://share.yandex.net/go.xml?service=vkontakte&amp;url=http://frontend.dev/&amp;title=Wishlist%20%2F%20sportstore"
                                                                                 data-service="vkontakte"><span
                                                                    class="b-share-icon b-share-icon_vkontakte"></span></a><a
                                                                rel="nofollow" target="_blank" title="Facebook"
                                                                class="b-share__handle b-share__link b-share-btn__facebook"
                                                                href="https://share.yandex.net/go.xml?service=facebook&amp;url=http://frontend.dev/&amp;title=Wishlist%20%2F%20sportstore"
                                                                data-service="facebook"><span
                                                                    class="b-share-icon b-share-icon_facebook"></span></a><a
                                                                rel="nofollow" target="_blank" title="Одноклассники"
                                                                class="b-share__handle b-share__link b-share-btn__odnoklassniki"
                                                                href="https://share.yandex.net/go.xml?service=odnoklassniki&amp;url=http://frontend.dev/&amp;title=Wishlist%20%2F%20sportstore"
                                                                data-service="odnoklassniki"><span
                                                                    class="b-share-icon b-share-icon_odnoklassniki"></span></a><a
                                                                rel="nofollow" target="_blank" title="Google Plus"
                                                                class="b-share__handle b-share__link b-share-btn__gplus"
                                                                href="https://share.yandex.net/go.xml?service=gplus&amp;url=http://frontend.dev/&amp;title=Wishlist%20%2F%20sportstore"
                                                                data-service="gplus"><span
                                                                    class="b-share-icon b-share-icon_gplus"></span></a></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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
<div id="forCenter" class="forCenter d_n" data-rel="#wishListPopup"
     style="left: 0px; width: 100%; position: fixed; height: 100%; overflow-x: auto; z-index: 1105; display: block; top: 0px; background: rgba(0, 0, 0, 0.8);">
    <div class="drop drop-style drop-wishlist center active" id="wishListPopup"
         style="z-index: 1105; position: fixed; display: block; top: 20%; left: 391px; width: 500px;">
        <button type="button" class="icon_times_drop" data-closed="closed-js" onclick="closeWishWindow()"></button>
        <div class="drop-header">
            <div class="title">
                Редактирование списка желаний
            </div>
        </div>
        <div class="drop-content" style="overflow: hidden; padding: 0px; height: 197px; width: 500px;">
            <div class="jspContainer" style="width: 500px; height: 189px;">
                <div class="jspPane" style="padding: 0px; top: 0px; width: 500px;">
                    <div class="inside-padd">
                        <div class="horizontal-form">
                            <?php $form = ActiveForm::begin();
                                $editWishList = new \common\models\WishList();
                                echo $form->field($editWishList, 'id')->hiddenInput(['id' => 'wishListId'])->label('');
                                echo $form->field($editWishList, 'title')->textInput(['style' => 'width: 287px;'])->label("Название списка:", ['style' => 'width: 160px;float:left;']);
                            ?>
                            <div class="frame-label" style="margin-bottom: 0;">
                                <div class="frame-form-field" style="margin-left: 160px; margin-top: 10px;">
                                    <div class="btn-def">
                                        <?php echo Html::submitButton('<span class="text-el">' . Yii::t('app', 'Сохранить') . '</span>>', ['class' => 'btn-search', 'style' => 'width: 180px;']) ?>
                                    </div>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="drop-footer"></div>
    </div>
</div>