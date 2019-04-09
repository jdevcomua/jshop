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
Url::current()
?>



<div class="box-content box-category">
    <ul>
        <?php foreach ($allCategories as $category) {
        $children = $category->getChildren()->all();
        if (empty($children))
        echo '<li> <a href="' . $category->getUrl()  . '">' . $category->title  . '</a> </li>';
        else {?>
        <li> <a class="active" href="<?= $category->getUrl() ?>"><?= $category->title ?></a> <span class="subDropdown plus"></span>
            <ul class="level0_415" style="display:none">
                <?php foreach ($children as $child) {
                $child_children = $child->getChildren()->all()?>
                <li> <a href="<?= $child->getUrl() ?>"><?= $child->title ?></a>
                    <?php if (!empty($child_children)) { ?>
                    <span class="subDropdown plus"></span>
                    <ul class="level1" style="display:block">
                        <?php foreach ($child_children as $child_child) { ?>
                        <li> <a href="<?= $child_child->getUrl() ?>"><span><?= $child_child->title ?></span></a> </li>
                        <?php }?>
                    </ul>
                    <?php }?>
                </li>
                <?php } ?>
            </ul>
            <!--level0-->

            <?php } }?>
    </ul>
</div>
