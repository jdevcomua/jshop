<?php
use common\models\ItemCat;
use yii\helpers\Url;

/* @var ItemCat[] $allCategories */
/* @var ItemCat[] $children */
/* @var ItemCat[] $child_children */
/* @var ItemCat $child */
/* @var ItemCat $child_child */
/* @var ItemCat $category */
/* @var $inCategory boolean */

?>
<li class="mega-menu"> <a class="level-top" href="" ><span><?= Yii::t('app','Categories') ?></span></a>


    <div class="level0-wrapper dropdown-6col">
        <div class="container">
            <div class="level0-wrapper2">
                <div class="col-1">
                    <div class="nav-block nav-block-center">
                        <!--mega menu-->
                        <ul class="level0">
                            <?php foreach ($allCategories as $category): ?>
                            <li class="level3 nav-6-1 parent item"> <a href="<?= $category->getUrl() ?>"><span><?= $category->title ?></span></a>
                                <!--sub sub category-->
                                <!--level1-->
                                <!--sub sub category-->
                            </li>
                            <?php endforeach;?>
                        </ul>
                        <!--level0-->
                    </div>
                    <!--nav-block nav-block-center-->
                </div>
                <!--col-1-->
            </div>
            <!--level0-wrapper2-->
        </div>
        <!--container-->
    </div>
    <!--level0-wrapper dropdown-6col-->
    <!--mega menu-->
</li>


