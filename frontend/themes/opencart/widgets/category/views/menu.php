<?php

use yii\helpers\Url;

/**@var common\models\ItemCat[] $allCategories*/
?>
<div class="container">
    <nav id="menu" class="navbar">
        <div class="navbar-header"><span id="category" class="visible-xs">Categories</span>
            <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
            <?php foreach($allCategories as $category):?>
                <li class="dropdown"><a href="<?= $category->getUrl()?>" class="dropdown-toggle" data-toggle="dropdown"><?= $category->title?></a>
                <?php if (!empty($category->children)) :?>
                    <div class="dropdown-menu">
                        <div class="dropdown-inner">
                            <ul class="list-unstyled">
                            <?php foreach($category->children as $subCategory) : ?>
                                <li>
                                    <a href="<?= $subCategory->getUrl()?>"><?= $subCategory->title?></a>
                                </li>
                            <?php endforeach;?>
                            </ul>
                        </div>
                        <a href="<?= $category->getUrl()?>" class="see-all">See All <?= $category->title?></a>
                    </div>
                <?php endif?>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
    </nav>
</div>