<?php
/* @var $categories \common\models\ItemCat[] */
?>
<div class="sidebar grid__item large--one-quarter">
    <div class="collection-sidebar">
        <div class="widget-category widget highlight">
            <h4 class="widget__title">Категории</h4>
            <div class="widget__content">
                <ul class="menu">
                    <?php foreach ($categories as $category) : ?>
                        <li>
                            <a href="<?= $category->getUrl() ?>" title="<?= $category->title ?>">
                                <?= $category->title ?> <span><?= $category->count ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
