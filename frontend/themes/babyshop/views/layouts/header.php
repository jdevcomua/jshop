<?php
use yii\helpers\Url;

?>

<header class="site-header">
    <div class="site-header_top" style="background-image: url(<?= '/images/babyshop/bg-header.jpg' ?>)">
        <div class="wrapper">
            <!-- /snippets/header.liquid -->
            <div class="grid">
                <div class="logo large--one-fifth grid__item">
                    <div class="h1 site-header__logo">
                        <a href="/" class="site-header__logo-link">
                            <img src="<?= '/images/babyshop/logo.png' ?>" alt="Baby shop">
                        </a>
                    </div>
                </div><!-- end logo -->

                <div class="site-header__topbar medium-down--hide large--four-fifths grid__item bgFull">

                    <div class="site-header__search large--right">
                        <!-- /snippets/search-bar.liquid -->
                        <form action="<?= Url::to(['/search']) ?>" method="get" class="input-group search-bar">
                            <input type="search" name="q" value="" placeholder="Поиск..."
                                   class="input-group-field" aria-label="Поиск...">
                            <span class="input-group-btn">
                                <button type="submit" class="btn icon-fallback-text">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </span>
                        </form>
                    </div> <!-- end search -->

                    <div class="site-header__account ultility-item large--left">
                        <span>
                            <a href="<?= Yii::$app->urlHelper->to(['user/login']) ?>">
                                <i class="fa fa-key"></i>
                                Вход
                            </a>
                        </span>
                        <span>
                            <a href="<?= Yii::$app->urlHelper->to(['user/register']) ?>">
                                <i class="fa fa-user"></i>
                                Регистрация
                            </a>
                        </span>

                    </div>
                    <!-- end account -->

                </div>

                <div class="large--four-fifths grid__item">
                    <div class="grid">
                        <div class="grid__item large--three-quarters">
                            <?= \frontend\widgets\category\CategoriesView::widget() ?>
                        </div>

                        <div class="grid__item large--one-quarter medium--one-quarter medium-down--hide">
                            <div class="large--right ">
                                <?php if (Yii::$app->cart->isEmpty()) : ?>
                                    <a id="cartEmpty"
                                       class="site-header__cart-toggle js-drawer-open-right btn--secondary"
                                       aria-controls="CartDrawer" aria-expanded="false">
                                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                        Корзина пуста
                                    </a>
                                    <a id="cartFull" href="<?= Yii::$app->urlHelper->to(['cart/index']) ?>"
                                       class="site-header__cart-toggle js-drawer-open-right btn--secondary d_n"
                                       aria-controls="CartDrawer" aria-expanded="false">
                                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                        Корзина (<span id="countItems"><?= Yii::$app->cart->getCount(); ?></span>)
                                    </a>
                                <?php else : ?>
                                    <a id="cartFull" href="<?= Yii::$app->urlHelper->to(['cart/index']) ?>"
                                       class="site-header__cart-toggle js-drawer-open-right btn--secondary"
                                       aria-controls="CartDrawer" aria-expanded="false">
                                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                        Корзина (<span id="countItems"><?= Yii::$app->cart->getCount(); ?></span>)
                                    </a>
                                <?php endif; ?>
                            </div><!--  end cart -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
