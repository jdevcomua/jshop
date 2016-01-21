<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use yii\helpers\Url;
//use Yii;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?php echo Yii::$app->language ?>">
    <head>
        <meta charset="<?php echo Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">>
        <?php echo Html::csrfMetaTags() ?>
        <style>.d_n {
                display: none!important;
            }</style>
        <script type="text/javascript"
                src="http://active.imagecmsdemo.net/templates/active/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="//backend.dev/onClickFunctions.js"></script>
        <title><?php echo Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => 'My Company',
            'brandUrl' => Yii::$app->urlHelper->to(['/']),
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $array = Yii::$app->request->queryParams;
        if(isset($array['language'])){
            unset($array['language']);
        }
        //var_dump(count($array));die();
        if(count($array) != 0){
            $url1 = Url::to(['ru/' . Yii::$app->controller->route , key($array) => current($array)]);
            $url2 = Url::to(['en/' . Yii::$app->controller->route, key($array) => current($array)]);
        } else {
            $url1 = Url::to(['ru/' . Yii::$app->controller->route]);
            $url2 = Url::to(['en/' . Yii::$app->controller->route]);
        }
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
                            <a href="<?php echo Yii::$app->urlHelper->to(['orders/index'])?>">
                                        Заказы</a>
                            <a href="">
                            <img width="20px" src="https://cdn4.iconfinder.com/data/icons/meBaze-Freebies/512/add.png">
                        </a></td>

                        <td class="dropdown" style="padding-right: 20px; padding-left: 20px;">
                            <a href="<?php echo Yii::$app->urlHelper->to(['item/index'])?>">
                                       Товары</a>
                            <a href="<?php echo Yii::$app->urlHelper->to(['item/create'])?>">
                                <img width="20px" src="https://cdn4.iconfinder.com/data/icons/meBaze-Freebies/512/add.png">
                            </a></td>
                        <td class="dropdown" style="padding-right: 20px; padding-left: 20px;"><a href="<?php echo Yii::$app->urlHelper->to(['item-cat/index'])?>">
                                Категории </a>
                            <a href="<?php echo Yii::$app->urlHelper->to(['item-cat/create'])?>">
                                <img width="20px" src="https://cdn4.iconfinder.com/data/icons/meBaze-Freebies/512/add.png">
                            </a></td>
                        <td class="dropdown" style="padding-right: 20px; padding-left: 20px;"><a href="<?php echo Yii::$app->urlHelper->to(['characteristic/index'])?>">
                                Характеристики</a>
                            <a href="<?php echo Yii::$app->urlHelper->to(['characteristic/create'])?>">
                                <img width="20px" src="https://cdn4.iconfinder.com/data/icons/meBaze-Freebies/512/add.png">
                            </a></td>
                        <td class="dropdown" style="padding-right: 20px; padding-left: 20px;">
                            <a href="<?php echo Yii::$app->urlHelper->to(['user/index'])?>">
                                        Пользователи </a>
                            <a href="<?php echo Yii::$app->urlHelper->to(['user/create'])?>">
                                <img width="20px" src="https://cdn4.iconfinder.com/data/icons/meBaze-Freebies/512/add.png">
                            </a></td>
                        <td class="dropdown" style="padding-right: 20px; padding-left: 20px;">
                            <a href="<?php echo Yii::$app->urlHelper->to(['vote/index'])?>">
                                Отзывы </a>
                            </td>
                        <td class="dropdown" style="padding-right: 20px; padding-left: 20px;">
                            <a href="<?php echo Yii::$app->urlHelper->to(['stock/index'])?>">
                                Акции </a>
                            <a href="<?php echo Yii::$app->urlHelper->to(['stock/create'])?>">
                                <img width="20px" src="https://cdn4.iconfinder.com/data/icons/meBaze-Freebies/512/add.png">
                            </a></td>

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