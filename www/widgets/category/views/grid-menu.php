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



<div class="box-content box-category">

    <ul>
        <?php foreach ($allCategories as $category) {
        $children = $category->getChildren()->all();
        $open_parent=0;
        $open_parent_child=0;
        if(isset(Yii::$app->controller->actionParams['id'])){
            foreach ($children as $ch){
                if($ch->id === (int)Yii::$app->controller->actionParams['id']){
                    $open_parent=$ch->parent->id;
                }
                $ch_children = $ch->getChildren()->all();
                if(isset($ch_children)){
                    foreach ($ch_children as $ch_ch){
                        if($ch_ch->id === (int)Yii::$app->controller->actionParams['id']){
                            $open_parent=$ch_ch->parent->parent->id;
                            $open_parent_child=$ch_ch->parent->id;
                        }
                    }
                }
            }
        }
        if (empty($children))
            echo '<li> <a href="' . $category->getUrl()  . '">' . $category->title  . '</a> </li>';
        else{

        if($category->id==$open_parent):?>
                <li> <a class="active" href="<?= $category->getUrl() ?>"><?= $category->title ?></a> <span class="subDropdown minus"></span>
                    <ul class="level0_415" style="display:block">
                        <?php foreach ($children as $child) {
                            $child_children = $child->getChildren()->all()?>
                            <li> <a href="<?= $child->getUrl() ?>"><?= $child->title ?></a>
                                <?php if (!empty($child_children)) {
                                    if($child->id==$open_parent_child):?>
                                        <span class="subDropdown minus"></span>
                                        <ul class="level1" style="display:block">
                                            <?php foreach ($child_children as $child_child) { ?>

                                                <li> <a href="<?= $child_child->getUrl() ?>"><span><?= $child_child->title ?></span></a> </li>
                                            <?php }?>
                                        </ul>
                                    <?php else:?>
                                        <span class="subDropdown plus"></span>
                                        <ul class="level1" style="display:none">
                                            <?php foreach ($child_children as $child_child) { ?>

                                                <li> <a href="<?= $child_child->getUrl() ?>"><span><?= $child_child->title ?></span></a> </li>
                                            <?php }?>
                                        </ul>

                                <?php endif;
                                }?>
                            </li>
                        <?php } ?>
                    </ul>
                    <!--level0-->
                </li>
        <?php else:?>
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
                </li>
            <?php endif;
        } }?>
    </ul>
</div>
