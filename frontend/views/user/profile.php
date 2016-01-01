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
                    <h1 class="title">umo4ka, Добро пожаловать!</h1>
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
                        <button data-href="#my_data"
                                data-source="http://active.imagecmsdemo.net/shop/profile/profile_data">Основные данные
                        </button>
                    </li>
                    <li class="" onclick="
                    $('.activeTab').toggleClass('d_n');
                    $('.activeTab').toggleClass('activeTab');
                    $('.active').toggleClass('active');
                    $(this).toggleClass('active');
                    $('#change_pass').toggleClass('d_n');
                    $('#change_pass').toggleClass('activeTab');">
                        <button data-href="#change_pass"
                                data-source="http://active.imagecmsdemo.net/shop/profile/profile_change_pass">Изменить
                            пароль
                        </button>
                    </li>
                    <li class="" onclick="
                    $('.activeTab').toggleClass('d_n');
                    $('.activeTab').toggleClass('activeTab');
                    $('.active').toggleClass('active');
                    $(this).toggleClass('active');
                    $('#history_order').toggleClass('d_n');
                    $('#history_order').toggleClass('activeTab');">
                        <button data-href="#history_order"
                                data-source="http://active.imagecmsdemo.net/shop/profile/profile_history">История заказа
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
                                                <?php echo Html::submitButton('<span class="text-el" style="color:#fff">Сохранить</span>', ['style' => 'background: #34a4e7;', 'name' => 'login-button']) ?>
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
                                            <span class="title">Старый пароль:</span>
                                            <span class="frame-form-field">
                                                <input type="password" name="old_password" style="width:250px;">
                                            </span>
                                        </label>
                                        <label>
                                            <span class="title">Новый пароль:</span>
                                            <span class="frame-form-field">
                                                <input type="password" name="new_password" style="width:250px;">
                                            </span>
                                        </label>
                                        <label>
                                            <span class="title">Повторите пароль:</span>
                                            <span class="frame-form-field">
                                                <input type="password" name="confirm_new_password" style="width:250px;">
                                            </span>
                                        </label>
                                        <div class="frame-label">
                                            <span class="title">&nbsp;</span>
                                            <span class="frame-form-field">
                                                <span class="btn-form">
                                                    <input type="submit" value="Изменить пароль">
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
                                    <th>Заказ #</th>
                                    <th>Время покупки</th>
                                    <th>Сумма покупки</th>
                                    <th>Статус заказа</th>
                                    <th>Статус платежа</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($model->orders as $order) {
                                    /* @var $order Orders */
                                    ?>
                                    <tr>
                                        <td><a href="<?php echo Yii::$app->urlHelper->to(['cart/order', 'id' => $order->id]); ?>">Заказ
                                                #<?php echo $order->id; ?></a></td>
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

                                        <td>Новый</td>
                                        <td> Не оплачен</td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="h-footer"></div>