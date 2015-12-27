<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use backend\models\UrlHelper;
use yii\helpers\Url;
use Yii;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?php echo Yii::$app->language ?>">
    <head>
        <meta charset="<?php echo Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo Html::csrfMetaTags() ?>
        <title><?php echo Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => 'My Company',
            'brandUrl' => UrlHelper::to(['/']),
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $url1 = Url::to(["site/language", "lang" => 'ru']);
        $url2 = Url::to(["site/language", "lang" => 'en']);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                "<a href='$url1'><img src='http://www.iconsearch.ru/uploads/icons/flags/32x32/russianfederation.png'/></a>",
                "<a href='$url2'><img src='http://www.iconsearch.ru/uploads/icons/flags/32x32/unitedstatesofamerica(usa).png'/></a>",

                Yii::$app->user->isGuest ?
                    ['label' => 'Login', 'url' => ['/site/login']] :
                    [
                        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ],
            ],
        ]);
        NavBar::end();
        ?>

        <div class="container">
           <!-- <?php echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?> -->

            <div class="frame_nav header-menu-out">
                <table>
                    <tbody><tr>
                        <td class="dropdown" style="padding-right: 20px; padding-left: 20px;">
                            <a href="<?php echo UrlHelper::to(['order-item/index'])?>">
                                        Список заказов </a></td>
                        <td class="dropdown" style="padding-right: 20px; padding-left: 20px;">
                            <a href="<?php echo UrlHelper::to(['item/index'])?>">
                                        Список товаров</a></td>
                        <td class="dropdown" style="padding-right: 20px; padding-left: 20px;"><a href="<?php echo UrlHelper::to(['item-cat/index'])?>">
                                Категории товаров </a></td>
                        <td class="dropdown" style="padding-right: 20px; padding-left: 20px;"><a href="<?php echo UrlHelper::to(['characteristic/index'])?>">
                                Свойства товаров</a></td>
                        <td class="dropdown" style="padding-right: 20px; padding-left: 20px;">
                            <a href="<?php echo UrlHelper::to(['user/index'])?>">
                                        Список пользователей </a></td>


                    <!--    <td class="dropdown"  style="padding-right: 20px; padding-left: 20px;">
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
                            </ul></td>-->

                    </tr>
            </tbody></table></div>

            <?php echo $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?php echo date('Y') ?></p>

        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>