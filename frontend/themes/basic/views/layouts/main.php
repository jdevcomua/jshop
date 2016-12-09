<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\themes\basic\BasicAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use frontend\widgets\category\CategoriesView;
use yii\helpers\Url;

$basicAsset =  BasicAsset::register($this);
?>

<?php $this->beginPage() ?>
<html>
<head>
    <meta charset="utf-8">
    <?php echo Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="isChrome shop_category notTouch">
<?php $this->beginBody() ?>
<div class="main-body">
    <div class="fon-header">
        <header>
            <div class="content-header">
                <div class="container">
                    <!--        Logo-->
                    <a href="<?php echo Yii::$app->urlHelper->to(['site/index']); ?>" class="logo">
                        <img src="<?= Url::base() . '/images/logo.png'?>" alt="logo">
                    </a>
                    <div class="left-content-header">
                        <div class="header-left-content-header t-a_j">
                            <!--                Start. contacts block-->
                            <div class="phones-header">
                                <div class="f-s_0 d_i-b v-a_b">
                                    <span class="icon_phone_header"></span>
                                    <span class="phone f-s_0">
                                        <span class="phone-number">(800) 568 56 56</span>
                                        <span class="phone-number">(800) 568 56 56</span>
                                    </span>
                                </div>
                                <div class="btn-order-call v-a_b">
                                    <button data-drop="#ordercall" data-tab="true"
                                            data-source="http://active.imagecmsdemo.net/shop/callback" class="isDrop">
                                        <span class="icon_order_call"></span>
                                        <span class="text-el ref-2"></span>
                                    </button>
                                </div>
                            </div>
                            <!--End. Contacts block-->
                            <div class="d_i-b f-s_0 f0I">
                                <nav class="d_i-b v-a_m">
                                    <ul class="nav nav-top-menu" style="max-width: none;">
                                        <li>
                                            <button type="button" title="Магазин" data-drop-filter="next()"
                                                    class="isDrop">
                                                <?php echo \Yii::t('app', 'Магазин'); ?> <span
                                                    class="icon-arrow-d"></span>
                                            </button>
                                            <ul class="sub-menu">
                                                <li><a href="http://active.imagecmsdemo.net/o-magazine" target="_self"
                                                       title="О магазине">О магазине</a></li>

                                                <li><a href="http://active.imagecmsdemo.net/dostavka" target="_self"
                                                       title="Доставка">Доставка</a></li>

                                                <li><a href="http://active.imagecmsdemo.net/oplata" target="_self"
                                                       title="Оплата">Оплата</a></li>

                                            </ul>
                                        </li>

                                        <li>
                                            <a href="<?php echo Yii::$app->urlHelper->to(['compare/compare']);?>">
                                                <?php echo \Yii::t('app', 'Сравнение'); ?>        </a>
                                        </li>

                                        <li>
                                            <a href="<?php echo Yii::$app->urlHelper->to(['promotions']);?>">
                                                <?php echo \Yii::t('app', 'Акции'); ?>        </a>
                                        </li>
                                        <?php
                                            $array = Yii::$app->request->queryParams;
                                            if(isset($array['language'])){
                                                unset($array['language']);
                                            }
                                        ?>
                                        <?php if(count($array) != 0): ?>
                                            <li><?= Html::a(Html::img($basicAsset->baseUrl . '/img/russianfederation.png',['width'=>20]), ['ru/' . Yii::$app->controller->route , key($array) => current($array)]) ?></li>
                                            <li><?= Html::a(Html::img($basicAsset->baseUrl . '/img/usa.png',['width'=>20]), ['en/' . Yii::$app->controller->route , key($array) => current($array)]) ?></li>
                                        <?php else: ?>
                                            <li><?= Html::a(Html::img($basicAsset->baseUrl . '/img/russianfederation.png',['width'=>20]), ['ru/' . Yii::$app->controller->route]) ?></li>
                                            <li><?= Html::a(Html::img($basicAsset->baseUrl . '/img/usa.png',['width'=>20]), ['en/' . Yii::$app->controller->route]) ?></li>
                                        <?php endif ?>
                                        <?php if (!Yii::$app->user->isGuest) : ?>
                                            <li><?= Html::a('Профиль', Yii::$app->urlHelper->to(['user/profile']), ['style' =>'color: #1083c7;'])?></li>
                                        <?php endif ?>
                                    </ul>
                                </nav>
                                <div class="d_i-b v-a_m">
                                    <nav>
                                        <ul class="nav nav-enter-reg">
                                            <li class="btn-enter-register">
                                                <span class="text-el">
                                                     <?php
                                                     if (!Yii::$app->user->isGuest) {
                                                         if (!empty(Yii::$app->user->identity->vk_id)) {
                                                             $username = Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->surname;
                                                         } elseif (!empty(Yii::$app->user->identity->fb_id)){
                                                             $username = Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->surname;
                                                         } else {
                                                             $username = Yii::$app->user->identity->username;
                                                         }
                                                     }
                                                     echo Nav::widget([
                                                         'options' => ['class' => 'navbar-nav navbar-right'],
                                                         'items' => [

                                                             Yii::$app->user->isGuest ?
                                                                 ['label' => Yii::t('app', 'Войти'), 'url' => Yii::$app->urlHelper->to(['user/login'])] :
                                                                 [
                                                                     'label' => 'Выйти (' . $username . ')',
                                                                     'url' => Yii::$app->urlHelper->to(['user/logout']),
                                                                     'linkOptions' => ['data-method' => 'post']
                                                                 ],
                                                         ],
                                                     ]);
                                                     ?>
                                                </span>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="frame-search-cleaner">
                            <!--                Start. Include cart data template-->
                            <div id="tinyBask" class="frame-cleaner">
                            <?php if (!Yii::$app->cart->isEmpty()) { ?>
                                <div id="cartFull" class="btn-bask pointer">
                                    <a href="<?php echo Yii::$app->urlHelper->to(['cart/index'])?>"><button type="button" class="btnBask" style="padding-top: 4px;">
                                        <span class="icon_cleaner"></span>
                                            <span class="text-cleaner">
                                                <span class="text-el"><?php echo \Yii::t('app', 'корзина'); ?></span>
                                                <span class="text-el">&nbsp;</span>
                                                <span class="text-el">(</span>
                                                <span id="countItems" class="text-el"><?php echo Yii::$app->cart->getCount(); ?></span>
                                                <span class="text-el">)</span>
                                            </span>
                                    </button></a>
                                </div>

                                <div id="cartEmpty" class="btn-bask d_n">
                                    <a style="margin-top:6px; height: 23px;padding-left: 4px;">
                                        <span class="icon_cleaner"></span>
                                        <span class="text-cleaner">
                                            <span class="text-el"><?php echo \Yii::t('app', 'корзина пуста'); ?></span>
                                        </span>
                                    </a>
                                </div>
                            <?php } else { ?>
                                <div id="cartFull" class="btn-bask pointer d_n">
                                    <a href="<?php echo Yii::$app->urlHelper->to(['cart/index'])?>"><button type="button" class="btnBask"  style="padding-top: 4px;">
                                        <span class="icon_cleaner"></span>
                                            <span class="text-cleaner">
                                                <span class="text-el"><?php echo \Yii::t('app', 'корзина'); ?></span>
                                                <span class="text-el">&nbsp;</span>
                                                <span class="text-el">(</span>
                                                <span id="countItems" class="text-el">0</span>
                                                <span class="text-el">)</span>
                                            </span>
                                    </button></a>
                                </div>

                                <div id="cartEmpty" class="btn-bask">
                                    <a style="margin-top:6px; height: 23px;padding-left: 4px;">
                                        <span class="icon_cleaner"></span>
                                        <span class="text-cleaner">
                                            <span class="text-el"><?php echo \Yii::t('app', 'корзина пуста'); ?></span>
                                        </span>
                                    </a>
                                </div>
                            <?php }?>
                            </div>
                            <!--                    End. Include cart data template-->
                            <!--                Start. Show search form-->
                            <div class="frame-search-form">
                                <div class="p_r">
                                    <form name="search" method="get" action="<?= Yii::$app->urlHelper->to(['search']) ?>">
                                        <span class="btn-search">
                                            <button type="submit"><span
                                                    class="text-el"><?php echo \Yii::t('app', 'поиск'); ?></span>
                                            </button>
                                        </span>
                                        <div class="frame-search-input">
                                            <span class="icon_search"></span>
                                            <input type="text" class="input-search" id="inputString" name="text"
                                                   required autocomplete="off" value=""
                                                   placeholder="<?php echo \Yii::t('app', 'Я ищу') ?>">
                                            <div id="suggestions" class="drop drop-search"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--                End. Show search form-->
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <?= CategoriesView::widget() ?>

        <div class="content">
            <div class="frame-inside page-product">
                <div class="container">
                    <?= Alert::widget() ?>

                    <?php echo $content; ?>
                </div>
            </div>
        </div>

        <div class="h-footer"></div>

        <footer>
            <div class="content-footer">
                <div class="container">
                    <div class="box-1">
                        <div class="inside-padd">

                            <a href="" class="logo">
                                <img src="<?= $basicAsset->baseUrl ?>/img/logo.png" alt="logo">
                            </a>
                            <ul>
                                <li><span class="f-s_16">(800) 568 56 56</span></li>
                                <li><span class="f-s_16">(800) 568 56 56</span></li>
                                <li>Звоните с 09:00 до 18:00</li>
                            </ul>

                        </div>

                    </div>
                    <div class="box-3">
                        <div class="inside-padd">
                            <div class="main-title">Информация</div>
                            <ul class="nav nav-vertical">

                                <li><a href="" title="О компании">О компании</a></li>

                                <li><a href="" title="Оптовым покупателям">Оптовым покупателям</a></li>

                                <li><a href="" title="Доставка и оплата">Доставка и оплата</a></li>

                                <li><a href="" title="Гарантии">Гарантии</a></li>

                                <li><a href="" title="Новости">Новости</a></li>

                                <li><a href="" title="Бренды">Бренды</a></li>

                                <li><a href="" title="Контакты">Контакты</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="box-4">
                        <div class="inside-padd">
                            <div class="main-title">наши преимущества</div>
                            <ul>
                                <li>Быстрая доставка</li>
                                <li>Гибкая система скидок</li>
                                <li>Полезная консультация</li>
                                <li>Качественный сервис</li>
                                <li>Широкий ассортимент</li>
                            </ul>
                        </div>

                    </div>
                    <div class="box-5">
                        <div class="inside-padd">
                            <div class="main-title">Контакты</div>
                            <ul class="items-contacts">
                                <li>info@active.com</li>
                                <li>active.com</li>
                                <li>Aдрес: ул. Солнечная, 85 Oфис 305</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="footer-footer">
                <div class="container">
                    <div class="t-a_j">
                        <div class="d_i-b v-a_m">
                            <div> © «Active» 2015 Все права защищены</div>
                        </div>
                        <div class="engine">
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script type="text/javascript">
            //initDownloadScripts(['united_scripts'], 'init', 'scriptDefer');
        </script>

        <div id="forCenter" class="forCenter d_n"
             style="left: 0; width: 100%; position: fixed; height: 100%; overflow-x: auto; z-index: 1105; display: block; top: 0; background: rgba(0, 0, 0, 0.8);">
            <div class="drop drop-style center active" id="popup"
                 style="z-index: 1105; position: fixed; display: block;">
                <button type="button" class="icon_times_drop" onclick="closePopup()"></button>
                <div class="drop-header">
                    <div class="title">
                    </div>
                </div>
                <div class="drop-content" style="overflow: hidden; padding: 0;">
                </div>
                <div class="drop-footer"></div>
            </div>
        </div>
        
        <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>