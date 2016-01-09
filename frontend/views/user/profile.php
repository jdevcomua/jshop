<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\User */

use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Orders;

?>

<?php echo $this->render('../layouts/menu', ['allCategories' => $allCategories]); ?>

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
                    <li class="active" onclick="
                    $('.activeTab').toggleClass('d_n');
                    $('.activeTab').toggleClass('activeTab');
                    $('.active').toggleClass('active');
                    $(this).toggleClass('active');
                    $('#my_data').toggleClass('d_n');
                    $('#my_data').toggleClass('activeTab');">
                        <button ><?php echo \Yii::t('app', 'Основные данные'); ?>
                        </button>
                    </li>
                    <li class="" onclick="
                    $('.activeTab').toggleClass('d_n');
                    $('.activeTab').toggleClass('activeTab');
                    $('.active').toggleClass('active');
                    $(this).toggleClass('active');
                    $('#change_pass').toggleClass('d_n');
                    $('#change_pass').toggleClass('activeTab');">
                        <button><?php echo \Yii::t('app', 'Изменить пароль'); ?>
                        </button>
                    </li>
                    <li class="" onclick="
                    $('.activeTab').toggleClass('d_n');
                    $('.activeTab').toggleClass('activeTab');
                    $('.active').toggleClass('active');
                    $(this).toggleClass('active');
                    $('#history_order').toggleClass('d_n');
                    $('#history_order').toggleClass('activeTab');">
                        <button><?php echo \Yii::t('app', 'История заказа'); ?>
                        </button>
                    </li>
                    <li id="wish" class="" onclick="
                    $('.activeTab').toggleClass('d_n');
                    $('.activeTab').toggleClass('activeTab');
                    $('.active').toggleClass('active');
                    $(this).toggleClass('active');
                    $('#wish_list').toggleClass('d_n');
                    $('#wish_list').toggleClass('activeTab');">
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
                        <style>.left-wishlist{float:left;width:22%;padding-top:20px}.right-wishlist{float:right;width:74%;border-left-width:1px;border-style:solid;padding-left:2%;padding-top:20px;margin-bottom:-10000px;padding-bottom:10000px}.left-wishlist-data{float:left;width:22%}.right-wishlist-data{float:right;width:74%}.left-wishlist .photo-block{width:100%}.frame-gen-sum-buy{padding:20px 16px 20px 30px;border-widht:1px;border-style:solid;border-radius:3px}.items-wish-data{margin-bottom:30px}.items-wish-data > li > .frame-photo-title{width:170px;position:relative}.items-wish-data.items-row > li > .description{margin-left:205px}.items-wish-data > li > .description > .title{margin-bottom:4px}.items-wish-data > li > .description > .date{margin-bottom:5px}.items-wish-data .photo-block{width:170px;height:170px;position:relative}.items-wish-data .photo-block > span{max-width:100%}.items-wish-data .frame-photo-title .group-buttons{position:absolute;left:0;top:0;bottom:0;right:0;margin:auto;z-index:1;width:100px;height:31px;display:none}.items-wish-data > li > .frame-photo-title .overlay{position:absolute;left:0;top:0;width:100%;height:100%}.items-wish-data .frame-photo-title .photo-block:hover .overlay{background-color:rgba(0,0,0,0.3)}.items-wish-data > li > .frame-photo-title:hover .group-buttons{display:block}.hidden input[type="file"]{width:100%;height:100%;position:absolute;left:0;top:0;opacity:0;-moz-opacity:0;-khtml-opacity:0;padding:0}.btn-remove-photo-wishlist > button,.btn-edit-photo-wishlist > button{width:auto;height:31px;text-align:center;padding:0 5px}.btn-remove-photo-wishlist > button > [class*="icon_"],.btn-edit-photo-wishlist > button > [class*="icon_"]{margin-right:0}.btn-remove-photo-wishlist,.btn-edit-photo-wishlist{border-width:1px;border-style:solid}.btn-edit-photo-wishlist{border-radius:2px 0 0 2px;margin-right:2px}.btn-remove-photo-wishlist{border-radius:0 2px 2px 0}.page-wishlist .btn-cart{margin-right:10px;float:left}.page-wishlist .btn-cart .text-el{text-transform:none;font-weight:bold}.frame-button-add-wish-list{overflow:hidden;margin-bottom:20px;padding:23px 28px;border-width:1px;border-style:solid;border-radius:1px}.check-public{width:300px}.check-public-drop{width:150px}.drop-edit-wishlist{width:500px}.drop-style-2{margin-bottom:20px;border-width:1px;border-style:solid;border-radius:1px}.drop-header2{border-bottom-width:1px;border-bottom-style:solid;padding:11px 23px 12px}.drop-header2 h2{font-size:13px;margin-bottom:0;font-weight:bold}.drop-style-2 > .drop-content2{border-bottom-style:solid;border-bottom-width:1px}.drop-style-2 > .drop-content2 > .inside-padd{padding:30px 20px}.drop-style-2 > .drop-footer2{border-radius:0 0 1px 1px}.drop-style-2 > .drop-footer2 > .inside-padd{padding:20px}.drop-style-2 > .drop-header{border-radius:1px 1px 0 0}.drop-wishlist-items > .drop-content2 > .inside-padd{padding:20px}.items-wish-list > li{margin-left:25px;margin-bottom:15px}.items-wish-list{margin-left:-25px}.funcs-buttons-WL-item{margin-bottom:5px}.funcs-buttons-wishlist{margin-right:10px}.funcs-buttons-wishlist > [class*="btn-"]{margin-right:10px;min-height:18px;vertical-align:baseline}.funcs-buttons-WL-item > [class*="btn-"]{margin-right:10px}.drop-wishlist{width:300px}.btn-edit-WL{margin-bottom:20px}.download-btn [disabled="disabled"],.download-btn.disabled{display:none}.btn-send-wishlist .text-el{font-weight:bold}.drop-sendemail{width:400px}.ui-datepicker-month,.ui-datepicker-year{height:20px}.page-wishlist .frame-tabs-ref > div:first-child{display:none}.tabs-wishlist{margin-bottom:18px}.tabs-wishlist > li{margin-bottom:3px}.tabs-wishlist > li > button{padding:3px 15px 5px;text-align:left;position:relative;border-radius:2px}.tabs-wishlist > .active > button:after{content:"";position:absolute;left:50%;top:100%;margin-left:-7px;border-width:6px 7px;border-style:solid}.tabs-wishlist > .active .text-el{border:0}.page-wishlist-one-WL{padding-bottom:0;overflow:hidden}</style>
                        <div class="inside-padd">
                            <div class="clearfix frame-tabs-ref">
                                <div id="list-products" style="display: block;">
                                    <div class="frame-button-add-wish-list">
                                        <div class="btn-buy">
                                            <button type="button" data-drop=".drop-add-wishlist" data-place="inherit"
                                                    data-overlay-opacity="0" data-effect-on="slideDown"
                                                    data-effect-off="slideUp" class="isDrop">
                                                <span class="icon_add_wish"></span>
                                                <span class="text-el">Создать новый список</span>
                                            </button>
                                        </div>
                                        <span class="help-block">В список избранных вы можете отложить понравившиеся товары, также показать список друзьям</span>
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
                                                    <ul class="items items-catalog items-wish-list">
                                                        <?php foreach ($list->getWishes()->all() as $wish) {
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
                                                                </div>
                                                            </div>
                                                            <!-- Start. Remove buttons if compare-->
                                                            <!-- End. Remove buttons if compare-->

                                                            <!-- Start. For wishlist page-->
                                                            <div class="funcs-buttons-WL-item">
                                                                <div class="btn-remove-item-wl">
                                                                    <button type="button" id="remove-<?php echo $wish->id?>"
                                                                            class="btnRemoveItem isDrop" onclick="
                                                                        $.ajax({
                                                                        url: '/site/delwish',
                                                                        data: { wish_id: <?php echo $wish->id ?> },
                                                                        dataType: 'text',
                                                                        success: function(){
                                                                        $('#wish-' + '<?php echo $wish->id ?>').toggleClass('d_n');
                                                                        }
                                                                        });
                                                                            "><span class="icon_remove"></span>
                                                                        <span class="text-el d_l_1">Удалить</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- End. For wishlist page-->
                                                            <div class="decor-element"></div>
                                                        </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="drop-footer2">
                                                <div class="inside-padd">
                                                    <div class="funcs-buttons-wishlist d_i-b">
                                                        <div class="btn-edit-WL">
                                                            <button type="button" class="isDrop">
                                                                <span class="d_l_1 text-el">Редактировать список</span>
                                                            </button>
                                                        </div>
                                                        <div class="btn-remove-WL">
                                                            <button type="button" class="isDrop" onclick="
                                                                $.ajax({
                                                                url: '/site/dellist',
                                                                data: { list_id: <?php echo $list->id ?> },
                                                                dataType: 'text',
                                                                success: function(){
                                                                $('#list-' + '<?php echo $list->id ?>').toggleClass('d_n');
                                                                }
                                                                });
                                                            ">
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
                                                             data-yasharelink="http://frontend.dev/"
                                                             data-yasharetype="none"
                                                             data-yasharequickservices="vkontakte,facebook,odnoklassniki,gplus,">
                                                        <span class="b-share"><a rel="nofollow" target="_blank"
                                                                                 title="ВКонтакте"
                                                                                 class="b-share__handle b-share__link b-share-btn__vkontakte"
                                                                                 href="https://share.yandex.net/go.xml?service=vkontakte&amp;url=http://frontend.dev/&amp;title=Wishlist%20%2F%20sportstore"
                                                                                 data-service="vkontakte"><span
                                                                    class="b-share-icon b-share-icon_vkontakte"></span></a><a
                                                                rel="nofollow" target="_blank" title="Facebook"
                                                                class="b-share__handle b-share__link b-share-btn__facebook"
                                                                href="https://share.yandex.net/go.xml?service=facebook&amp;url=http%3A%2F%2Factive.imagecmsdemo.net%2Fwishlist%2Fshow%2FZoupFHdJXSFslddo&amp;title=Wishlist%20%2F%20sportstore"
                                                                data-service="facebook"><span
                                                                    class="b-share-icon b-share-icon_facebook"></span></a><a
                                                                rel="nofollow" target="_blank" title="Одноклассники"
                                                                class="b-share__handle b-share__link b-share-btn__odnoklassniki"
                                                                href="https://share.yandex.net/go.xml?service=odnoklassniki&amp;url=http%3A%2F%2Factive.imagecmsdemo.net%2Fwishlist%2Fshow%2FZoupFHdJXSFslddo&amp;title=Wishlist%20%2F%20sportstore"
                                                                data-service="odnoklassniki"><span
                                                                    class="b-share-icon b-share-icon_odnoklassniki"></span></a><a
                                                                rel="nofollow" target="_blank" title="Google Plus"
                                                                class="b-share__handle b-share__link b-share-btn__gplus"
                                                                href="https://share.yandex.net/go.xml?service=gplus&amp;url=http%3A%2F%2Factive.imagecmsdemo.net%2Fwishlist%2Fshow%2FZoupFHdJXSFslddo&amp;title=Wishlist%20%2F%20sportstore"
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