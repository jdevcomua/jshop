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

 <?php foreach ($allCategories as $category) {
     $children = $category->getChildren()->all();;
     if (empty($children))
         echo '<li class="mega-menu"> 
            <a class="level-top" href="' . $category->getUrl()  . '"><span>' . $category->title  . '</span></a> </li>';
     else {?>

<li class="mega-menu"> <a class="level-top" href="<?= $category->getUrl() ?>"><span><?= $category->title ?></span></a>
    <div class="level0-wrapper dropdown-6col">
        <div class="container">
            <div class="level0-wrapper2">
                <div class="col-1">
                    <div class="nav-block nav-block-center">
                        <!--mega menu-->
                        <ul class="level0">
                            <?php foreach ($children as $child) {
                                $child_children = $child->getChildren()->all()?>
                            <li class="level3 nav-6-1 parent item"> <a href="<?= $child->getUrl() ?>"><span><?= $child->title ?></span></a>
                                <!--sub sub category-->
                                <?php if(!empty($child_children)) {?>
                                <ul class="level1">
                                    <?php foreach ($child_children as $child_child) { ?>
                                    <li class="level2 nav-6-1-1"> <a href="<?= $child_child->getUrl() ?>"><span><?= $child_child->title ?></span></a> </li>
                                    <!--level2 nav-6-1-1-->
                                   <?php } ?>
                                </ul>
                                <?php }?>
                                <!--level1-->
                                <!--sub sub category-->
                            </li>
                            <?php }?>
                        </ul>
                        <!--level0-->
                    </div>
                    <!--nav-block nav-block-center-->
                </div>
                <!--col-1-->
                <div class="col-2">
                    <div class="menu_image"><a title="" href="<?= $category->getUrl() ?>">
                            <img alt="menu_image" src="<?= ($category->image) ? $category->image : '/images/category_no_image.jpg'?>"></a></div>
                </div>
                <!--col-2-->
            </div>
            <!--level0-wrapper2-->
        </div>
        <!--container-->
    </div>
    <!--level0-wrapper dropdown-6col-->
    <!--mega menu-->
</li>

<?php } }?>
