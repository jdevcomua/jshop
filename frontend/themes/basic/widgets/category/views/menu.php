<?php

/**@var common\models\ItemCat[] $allCategories*/
?>

<div class="frame-menu-main horizontal-menu">
    <!--    menu-row-category || menu-col-category-->
    <div class="menu-main menu-row-category container">
        <nav>
            <table>
                <tbody>
                <tr>
                    <?php
                    foreach ($allCategories as $category) {
                        /* @var $category \common\models\ItemCat*/
                        ?>
                        <td>
                            <div class="frame-item-menu">
                                <div class="frame-title is-sub" onmouseover="$(this).parent().find('.frame-drop-menu').attr('style', 'left:initial;display:block;');"
                                     onmouseout="$(this).parent().find('.frame-drop-menu').attr('style', 'display:none;');">
                                    <a href="<?= $category->getUrl() ?>" class="title active">
                                        <span class="helper"></span><span><span class="text-el"><?php echo $category->title; ?></span></span>
                                    </a>
                                </div>
                                <?php $children = $category->getChildren()->all();
                                if (!empty($children)) { ?>
                                    <div class="frame-drop-menu" style="left: initial;" onmouseover="$(this).attr('style', 'left:initial;display:block;');"
                                         onmouseout="$(this).attr('style', 'display:none;');">
                                        <ul class="items">
                                            <?php foreach ($children as $child_category) {
                                                /* @var $child_category \common\models\ItemCat*/
                                                $children2 = $child_category->getChildren()->all(); ?>
                                                <li class="column_0" onmouseover="$(this).find('.frame-l2').attr('style', 'display:block;');"
                                                    onmouseout="$(this).find('.frame-l2').attr('style', 'display:none;');">
                                                    <a href="<?php echo Yii::$app->urlHelper->to(['category/' . $child_category->id . '-' . $child_category->getTranslit()]);?>"
                                                       class="title-category-l1  is-sub">
                                                        <span class="helper"></span>
                                                        <span class="text-el"><?php echo $child_category->title; ?></span>
                                                    </a>
                                                    <?php if (!empty($children2)) {?>
                                                        <div class="frame-l2">
                                                            <ul class="items">
                                                                <?php foreach ($children2 as $child_category2) {
                                                                    /* @var $child_category2 \common\models\ItemCat*/ ?>
                                                                    <li style="width: 150px;padding: 7px 0 7px 0;">
                                                                        <a
                                                                            href="<?php echo Yii::$app->urlHelper->to(['category/' . $child_category2->id . '-' . $child_category2->getTranslit()]);?>">
                                                                            <?php echo $child_category2->title; ?>
                                                                        </a>
                                                                    </li>
                                                                <?php }?>
                                                            </ul>
                                                        </div>
                                                    <?php } ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php }?>
                            </div>
                        </td>
                    <?php } ?>
                </tr>
                </tbody>
            </table>
        </nav>
    </div>
</div>

