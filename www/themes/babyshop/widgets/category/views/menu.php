<?php
use common\models\ItemCat;
use yii\helpers\Url;

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
                        <span class="fallback-text">Меню</span>
                    </button>
                </div>
            </div>
            <div class="grid__item one-half text-right">
                <div class="site-nav--mobile">
                    <a href="<?= Url::to('cart') ?>" class="js-drawer-open-right site-nav__link"
                       aria-controls="CartDrawer" aria-expanded="false">
                        <span class="icon-fallback-text">
                            <span class="sprite sprite-cart" aria-hidden="true"></span>
                            <span class="fallback-text">Козина</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
