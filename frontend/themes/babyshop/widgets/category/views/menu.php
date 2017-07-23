<?php
use common\models\ItemCat;

/* @var ItemCat[] $allCategories */
/* @var $inCategory boolean */
?>

<nav class="nav-bar keep-this" role="navigation">
    <!-- /snippets/menu.liquid -->
    <div class="medium-down--hide">
        <!-- begin site-nav -->
        <ul class="site-nav" id="AccessibleNav">

            <?php foreach ($allCategories as $category) {
                $children = $category->getChildren()->all(); ?>
                <li class="site-nav--has-dropdown" aria-haspopup="true">
                    <a href="<?= $category->getUrl() ?>" class="site-nav__link">
                        <?= $category->title; ?>
                        <?php if (!empty($children)) { ?>
                            <span class="fa fa-angle-down" aria-hidden="true"></span>
                        <?php } ?>
                    </a>
                    <?php if (!empty($children)) { ?>
                        <ul class="site-nav__dropdown">
                            <?php foreach ($children as $childCategory) {
                                /* @var $childCategory ItemCat */ ?>
                                <li>
                                    <a href="<?= $childCategory->getUrl(); ?>">
                                        <?= $childCategory->title ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
            <?php } ?>

            <li class="site-nav--has-dropdown megamenu-dropdown" aria-haspopup="true">
                <a href="#" class="site-nav__link">
                    Accessories
                    <span class="fa fa-angle-down" aria-hidden="true"></span>
                </a>
                <ul class="site-nav__dropdown">
                    <li class="awemenu-megamenu-item">
                        <div class="grid">


                            <div class="grid__item large--one-quarter">
                                <h3>Collection</h3>
                                <ul class="super">

                                    <li><a href="/collections/air-storm">Air Storm</a></li>

                                    <li><a href="/collections/big-hero-6">Big Hero 6</a>
                                    </li>

                                    <li><a href="/collections/clementoni">Clementoni</a>
                                    </li>

                                    <li><a href="/collections/hello-kitty">Hello Kitty</a>
                                    </li>

                                    <li><a href="/collections">All collection</a></li>

                                </ul>
                            </div>


                            <div class="grid__item large--one-quarter">
                                <h3>New Arrivals</h3>
                                <ul class="super">

                                    <li><a href="/apps/help-center">Help center</a></li>

                                    <li><a href="/blogs/news">Blog</a></li>

                                    <li><a href="/search">Search </a></li>

                                    <li><a href="#">Custom link</a></li>

                                </ul>
                            </div>


                            <div class="grid__item large--one-quarter">
                                <h3>Brand</h3>
                                <ul class="super">

                                    <li><a href="/collections/air-storm">Air Storm</a></li>

                                    <li><a href="/collections/big-hero-6">Big Hero 6</a>
                                    </li>

                                    <li><a href="/collections/clementoni">Clementoni</a>
                                    </li>

                                    <li><a href="/collections/hello-kitty">Hello Kitty</a>
                                    </li>

                                    <li><a href="/collections">All collection</a></li>

                                </ul>
                            </div>

                            <div class="grid__item large--one-quarter">


                                <h3>Shop</h3>

                                <a href="#">

                                    <img
                                        src="//cdn.shopify.com/s/files/1/1252/2743/t/2/assets/megamenu_1_image_1.jpg?203141088333881552"
                                        alt="image">

                                </a>

                            </div>
                        </div>
                    </li>
                </ul>
            </li>

        </ul>
        <!-- //site-nav -->
    </div>
    <div class="large--hide medium-down--show">
        <div class="grid">
            <div class="grid__item one-half">
                <div class="site-nav--mobile">
                    <button type="button" class="icon-fallback-text site-nav__link js-drawer-open-left"
                            aria-controls="NavDrawer" aria-expanded="false">
                        <span class="icon icon-hamburger" aria-hidden="true"></span>
                        <span class="fallback-text">Menu</span>
                    </button>
                </div>
            </div>
            <div class="grid__item one-half text-right">
                <div class="site-nav--mobile">
                    <a href="/cart" class="js-drawer-open-right site-nav__link"
                       aria-controls="CartDrawer" aria-expanded="false">
                        <span class="icon-fallback-text">
                            <span class="sprite sprite-cart" aria-hidden="true"></span>
                            <span class="fallback-text">Cart</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
