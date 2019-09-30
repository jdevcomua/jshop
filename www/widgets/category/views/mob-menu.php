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
        echo '<li><a href="' . $category->getUrl()  . '">' . $category->title  . '</a></li>';
    else {?>

        <li><a href="<?= $category->getUrl() ?>"><?= $category->title ?></a>
            <ul>
                <?php foreach ($children as $child) {
                    $child_children = $child->getChildren()->all()?>
                    <li><a href="<?= $child->getUrl() ?>"><?= $child->title ?>‎</a>
                        <!--sub sub category-->
                        <?php if(!empty($child_children)) {?>
                            <ul>
                                <?php foreach ($child_children as $child_child) { ?>
                                    <li> <a href="<?= $child_child->getUrl() ?>"><?= $child_child->title ?></a> </li>
                                <?php } ?>
                            </ul>
                        <?php }?>
                    </li>
                <?php }?>
            </ul>
        </li>


    <?php } }?>
