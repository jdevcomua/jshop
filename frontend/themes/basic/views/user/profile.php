<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\User */
/* @var $changePasswordModel \frontend\models\ChangePassword */

use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Orders;
use yii\widgets\ListView;

$this->title = 'Профиль пользователя';
?>

<div class="f-s_0 title-profile without-crumbs">
    <div class="frame-title">
        <h1 class="title">umo4ka, <?php echo \Yii::t('app', 'Добро пожаловать!'); ?></h1>
    </div>
</div>
<div class="left-personal f-s_0">
    <ul class="tabs tabs-data nav nav-tabs">
        <li class="active" onclick="">
            <a href="#my_data" data-toggle="tab"><?php echo \Yii::t('app', 'Основные данные'); ?>
            </a>
        </li>
        <li class="" onclick="">
            <a href="#change_pass" data-toggle="tab"><?php echo \Yii::t('app', 'Изменить пароль'); ?>
            </a>
        </li>
        <li class="" onclick="">
            <a href="#history_order" data-toggle="tab"><?php echo \Yii::t('app', 'История заказа'); ?>
            </a>
        </li>
        <li id="wish" class="" onclick="">
            <a href="#wish_list" data-toggle="tab"><?php echo \Yii::t('app', 'Список желаний'); ?>
            </a>
        </li>
    </ul>
    <div class="frame-tabs-ref frame-tabs-profile tab-content">
        <div id="my_data" class="tab-pane active">
            <div class="inside-padd clearfix">
                <div class="frame-change-profile">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="horizontal-form">
                        <?php echo $form->field($model, 'username')->textInput(); ?>

                        <?php echo $form->field($model, 'mail')->textInput(); ?>

                        <?php echo $form->field($model, 'name')->textInput(); ?>

                        <?php echo $form->field($model, 'surname')->textInput(); ?>

                        <?php echo $form->field($model, 'phone')->textInput(); ?>

                        <?php echo $form->field($model, 'address')->textInput(); ?>

                        <div class="frame-label">
                            <span class="title">&nbsp;</span>
                            <div class="frame-form-field">
                                <div class="btn-form m-b_15">
                                    <?php echo Html::submitButton('<span class="text-el" style="color:#fff">'
                                        . Yii::t('app', 'Сохранить') . '</span>', ['style' => 'background: #34a4e7;', 'name' => 'login-button']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div id="change_pass" class="tab-pane">
            <div class="inside-padd">
                <div class="frame-change-password">
                    <div class="horizontal-form big-title">
                        <?php $form = ActiveForm::begin(['action' => Yii::$app->urlHelper->to(['profile#change_pass'])]); ?>

                        <?= $form->field($changePasswordModel, 'oldPassword')->input('password') ?>

                        <?= $form->field($changePasswordModel, 'newPassword')->input('password') ?>

                        <?= $form->field($changePasswordModel, 'confirmNewPassword')->input('password') ?>

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
        <div id="history_order" class="tab-pane">
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
                        /* @var $order Orders */ ?>
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
        <div id="wish_list" class="tab-pane">
            <div class="inside-padd">
                <div class="clearfix frame-tabs-ref">
                    <div id="list-products" style="display: block;">
                        <div style="margin-bottom: 17px;">
                            <div class="btn-buy">
                                <button type="button" class="isDrop"
                                        onclick="$('.drop-add-wishlist').toggleClass('d_n')">
                                    <span class="icon_add_wish"></span>
                                    <span class="text-el">Создать новый список</span>
                                </button>
                            </div>
                            <span class="help-block">В список избранных вы можете отложить понравившиеся товары, также показать список друзьям</span>
                        </div>
                        <div class="drop drop-style-2 d_n drop-add-wishlist active inherit"
                             style="display: block; z-index: 1104;">
                            <div class="drop-header">
                                <div class="title">Создание списка желаний</div>
                            </div>
                            <div class="drop-content2">
                                <div class="inside-padd">
                                    <div class="horizontal-form big-title">
                                        <?php $form = ActiveForm::begin(); ?>
                                        <?= $form->field(new \common\models\WishList(), 'title')->textInput(); ?>
                                        <!--<label>
                                            <span class="title">Описание:</span>
                                            <span class="frame-form-field">
                                                <textarea name="wlDescription"></textarea>
                                            </span>
                                        </label>-->
                                        <div class="frame-label" style="margin-bottom: 0;">
                                            <div class="frame-form-field" style="margin-left: 160px; margin-top: 10px;">
                                                <div class="btn-def">
                                                    <?php echo Html::submitButton('<span class="text-el">' . Yii::t('app', 'Создать новый список')
                                                        . '</span>>', ['class' => 'btn-search', 'style' => 'width: 180px;']) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php foreach ($model->getWishLists()->all() as $list) {
                            /* @var $list \common\models\WishList */
                            ?>
                            <div id="list-<?php echo $list->id ?>" class="drop-style-2 drop-wishlist-items"
                                 data-rel="list-item">
                                <div class="drop-header2">
                                    <h2><?php echo $list->title; ?></h2>
                                </div>
                                <div class="drop-content2">
                                    <div class="inside-padd">
                                        <ul style="font-size: 12px; margin-left: 0; "
                                            class="items items-catalog items-wish-list">
                                            <?php
                                            if (empty($list->getWishes()->all())) { ?>
                                                Список пуст
                                            <?php } else {
                                                $dataProvider = new \yii\data\ActiveDataProvider([
                                                    'query' => $list->getWishes()
                                                ]);
                                                echo ListView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'itemView' => function ($model, $key, $index, $widget) {
                                                        return $this->render('../site/item', ['value' => $model->item,
                                                            'wishListPage' => true, 'wishId' => $model->id]);
                                                    },
                                                    'options' => [
                                                        'tag' => 'ul',
                                                        'class' => 'items items-catalog table',
                                                        'id' => 'items-catalog-main',
                                                    ],
                                                    'itemOptions' => [
                                                        'tag' => 'li',
                                                        'class' => 'globalFrameProduct to-cart',
                                                        'style' => 'width: 20%!important; margin-left: 44px;'
                                                    ],
                                                ]);
                                            } ?>
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
                                                <button type="button" class="isDrop"
                                                        onclick="removeWishList(<?php echo $list->id ?>)">
                                                    <span class="icon_remove"></span>
                                                    <span class="text-el d_l_1">Удалить список</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d_i-b">
                                            <script type="text/javascript" src="http://yandex.st/share/share.js"
                                                    charset="utf-8"></script>
                                            <div class="yashare-auto-init" data-yasharel10n="ru"
                                                 data-yasharelink="<?= Yii::$app->request->hostInfo . Yii::$app->urlHelper->to(['user/wishlist', 'id' => $list->id]); ?>"
                                                 data-yasharetype="none" data-yashareTitle="Мой список желаний"
                                                 data-yashareDescription='Хочу купить в "active"'
                                                 data-yashareImage="http://s017.radikal.ru/i421/1601/46/57881a3ba8e9.jpg"
                                                 data-yasharequickservices="vkontakte,facebook,odnoklassniki,gplus,">
                                                <span class="b-share">
                                                    <a rel="nofollow" target="_blank"
                                                       title="ВКонтакте"
                                                       class="b-share__handle b-share__link b-share-btn__vkontakte"
                                                       href="https://share.yandex.net/go.xml?service=vkontakte&amp;url=<?= Yii::$app->request->hostInfo ?>/&amp;title=Wishlist%20%2F%20sportstore"
                                                       data-service="vkontakte">
                                                        <span class="b-share-icon b-share-icon_vkontakte"></span>
                                                    </a>
                                                    <a rel="nofollow" target="_blank" title="Facebook"
                                                       class="b-share__handle b-share__link b-share-btn__facebook"
                                                       href="https://share.yandex.net/go.xml?service=facebook&amp;url=<?= Yii::$app->request->hostInfo ?>/&amp;title=Wishlist%20%2F%20sportstore"
                                                       data-service="facebook">
                                                        <span class="b-share-icon b-share-icon_facebook"></span>
                                                    </a>
                                                    <a rel="nofollow" target="_blank" title="Одноклассники"
                                                       class="b-share__handle b-share__link b-share-btn__odnoklassniki"
                                                       href="https://share.yandex.net/go.xml?service=odnoklassniki&amp;url=<?= Yii::$app->request->hostInfo ?>/&amp;title=Wishlist%20%2F%20sportstore"
                                                       data-service="odnoklassniki">
                                                        <span class="b-share-icon b-share-icon_odnoklassniki"></span>
                                                    </a>
                                                    <a rel="nofollow" target="_blank" title="Google Plus"
                                                       class="b-share__handle b-share__link b-share-btn__gplus"
                                                       href="https://share.yandex.net/go.xml?service=gplus&amp;url=<?= Yii::$app->request->hostInfo ?>/&amp;title=Wishlist%20%2F%20sportstore"
                                                       data-service="gplus">
                                                        <span class="b-share-icon b-share-icon_gplus"></span>
                                                    </a>
                                                </span>
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
