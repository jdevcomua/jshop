<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => 'My Company',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                Yii::$app->user->isGuest ?
                    ['label' => 'Login', 'url' => ['/site3/login']] :
                    [
                        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site3/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ],
            ],
        ]);
        NavBar::end();
        ?>

        <div class="container">
           <!-- <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?> -->

            <div class="frame_nav header-menu-out">
                <table>
                    <tbody><tr><td class="dropdown" style="padding-right: 20px; padding-left: 20px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Заказы
                                <!--<span class="menu-counter">4</span>--> </a>
                            <ul class="dropdown-menu">
                                <li><a href="?r=orders">
                                        Список заказов </li>
                                <li><a href="/admin/components/run/shop/orderstatuses">
                                        Статусы заказов</a></li>
                                <li class="divider"></li>
                                <li><a href="/admin/components/run/shop/callbacks">
                                        Список обратных звонков</a></li>
                                <li><a href="/admin/components/run/shop/callbacks/statuses">
                                        Статусы обратных звонков</a></li>
                                <li><a href="/admin/components/run/shop/callbacks/themes">
                                        Темы обратных звонков</a></li>
                                <li class="divider"></li>
                                <li><a href="/admin/components/run/shop/notifications">
                                        Уведомления о появлении</a></li>
                                <li><a href="/admin/components/run/shop/notificationstatuses/index">
                                        Статусы уведомлений</a></li>
                            </ul></td>
                        <td class="dropdown" style="padding-right: 20px; padding-left: 20px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Каталог товаров</a>
                            <ul class="dropdown-menu">
                                <li><a href="?r=item">
                                        Список товаров</a></li>
                                <li><a href="?r=item-cat">
                                        Категории товаров </a></li>
                                <li><a href="?r=characteristic">
                                        Свойства товаров</a></li>
                                <li><a href="/admin/components/run/shop/kits/index">
                                        Наборы товаров </a></li>
                                <li><a href="/admin/components/run/shop/search?WithoutImages=1">
                                        Товары без картинок </a></li>
                                <li><a href="/admin/components/run/shop/brands/index">
                                        Бренды </a></li>
                            </ul></td>
                        <td class="dropdown" style="padding-right: 20px; padding-left: 20px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Пользователи</a>
                            <ul class="dropdown-menu">
                                <li><a href="?r=users">
                                        Список пользователей </a></li>
                                <li><a href="/admin/rbac/roleList">
                                        Управление правами доступа </a></li>
                                <li><a href="/admin/components/cp/comments">
                                        Комментарии </a></li>
                            </ul></td>
                        <td class="dropdown" style="padding-right: 20px; padding-left: 20px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Модули</a>
                            <ul class="dropdown-menu" style="min-width: 250px;">
                                <li><a style="padding: 3px 15px;" href="/admin/components/cp/template_manager">
                                        <i class="icon-th-large" style="margin-right: 5px;top: 2px;"></i>
                                        Управление дизайном</a></li>
                                <li><a style="padding: 3px 15px;" href="/admin/components/cp/xbanners">
                                        <i class="fa fa-picture-o" style="margin-right: 5px;top: 2px;"></i>
                                        Баннеры</a></li>
                                <li><a style="padding: 3px 15px;" href="/admin/components/cp/menu">
                                        <i class="icon-align-justify" style="margin-right: 5px;top: 2px;"></i>
                                        Меню</a></li>
                                <li><a style="padding: 3px 15px;" href="/admin/components/cp/mod_discount">
                                        <i class="icon-gift" style="margin-right: 5px;top: 2px;"></i>
                                        Скидки интернет-магазина</a></li>
                                <li><a style="padding: 3px 15px;" href="/admin/components/cp/wishlist">
                                        <i class="icon-th" style="margin-right: 5px;top: 2px;"></i>
                                        Списки пожеланий</a></li>
                                <li><a style="padding: 3px 15px;" href="/admin/components/cp/cmsemail">
                                        <i class="icon-envelope" style="margin-right: 5px;top: 2px;"></i>
                                        Управление email-уведомлениями </a></li>
                                <li><a style="padding: 3px 15px;" href="/admin/components/cp/comments">
                                        <i class="icon-comment" style="margin-right: 5px;top: 2px;"></i>
                                        Комментарии</a></li>
                                <li><a style="padding: 3px 15px;" href="/admin/components/cp/share">
                                        <i class="icon-globe" style="margin-right: 5px;top: 2px;"></i>
                                        Кнопки социальных сетей</a></li>
                            </ul></td>
                        <td class="dropdown"  style="padding-right: 20px; padding-left: 20px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Статистика</a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="/admin/components/cp/mod_stats/orders/info">
                                        Заказы </a></li>
                                <li><a href="/admin/components/cp/mod_stats/users/online">
                                        Пользователи </a></li>
                                <li><a href="/admin/components/cp/mod_stats/products/categories">
                                        Товары </a></li>
                                <li><a href="/admin/components/cp/mod_stats/categories/attendance">
                                        Категории</a></li>
                                <li><a href="/admin/components/cp/mod_stats/search/keywords">
                                        Поиск</a></li>
                            </ul></td>
                        <td class="dropdown"  style="padding-right: 20px; padding-left: 20px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Настройки</a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="/admin/settings">
                                        Глобальные настройки</a></li>
                                <li><a href="/admin/components/run/shop/settings">
                                        Настройки магазина</a></li>
                                <li class="divider"></li>
                                <li><a href="/admin/components/run/shop/currencies">
                                        Валюты</a></li>
                                <li><a href="/admin/components/run/shop/deliverymethods/index">
                                        Способы доставки</a></li>
                                <li><a href="/admin/components/run/shop/paymentmethods/index">
                                        Способы оплаты</a></li>
                                <li class="divider"></li>
                                <li><a href="/admin/widgets_manager">
                                        Виджеты </a></li>
                                <li><a href="/admin/components/run/shop/customfields">
                                        Дополнительные поля</a></li>
                                <li><a href="/admin/components/cp/template_editor">
                                        Редактор шаблонов </a></li>
                                <li><a href="/admin/languages">
                                        Языки</a></li>
                                <li class="divider"></li>
                                <li><a href="/admin/admin_logs">
                                        Журнал событий </a></li>
                                <li><a href="/admin/backup">
                                        Резервное копирование </a></li>
                                <li><a href="/admin/rbac/roleList">
                                        Управление правами доступа </a></li>
                                <li class="divider"></li>
                                <li><a href="/admin/sys_update">
                                        Обновление системы </a></li>
                                <li><a href="/admin/sys_info">
                                        Информация системы</a></li>
                                <li class="divider"></li>
                                <li><a id="clearAllCache">
                                        Очистить кеш</a></li>
                            </ul>
                        </td></tr>
            </tbody></table></div>

            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>