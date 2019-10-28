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
<li class="mega-menu"> <a class="level-top" ><span><?= Yii::t('app','Categories') ?></span></a>

    <div class="level0-wrapper dropdown-6col">
        <div class="container">
            <div class="level0-wrapper2">
                <div class="col-2">
                    <div class="nav-block">
                        <!--mega menu-->
                        <ul class="level5">
                            <?php foreach ($allCategories as $category): ?>

                            <li class="level3 nav-6-1 parent item" <?php if(!empty($category->children)):?>data-id="<?=$category->id?>" <?php endif;?>>
                                <a href="<?= $category->getUrl() ?>">
                                    <div style="width: 95%;">
                                        <span><?= $category->title ?></span>
                                    </div>

                                    <?php if(!empty($category->children)): ?>
                                        <div style="width: 5%;">
                                            <span class="next-button"></span>
                                        </div>
                                    <?php endif;?>
                                </a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                        <!--level0-->
                    </div>
                    <!--nav-block nav-block-center-->
                </div>
                <!--col-1-->
                <?php foreach ($allCategories as $category): ?>

                <div class="col-1 background-lightgrey d-none" id="<?=$category->id?>">
                    <div class="nav-block nav-block-center">
                        <ul class="level0">
                            <?php foreach ($category->children as $children): ?>
                            <li class="level3 nav-6-1 parent item"> <a href="<?=$children->getUrl()?>"><span><?=$children->title?></span></a>
                                <ul class="level1">
                                    <?php foreach ($children->children as $child_children): ?>
                                        <li class="level2 nav-6-1-1"> <a href="<?=$child_children->getUrl()?>"><span><?=$child_children->title?></span></a> </li>
                                    <?php endforeach;?>
                                </ul>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</li>

<script>
    var prevMenuId;
    var prevMenuItem;
    document.addEventListener('DOMContentLoaded', function(){
        $('.level0-wrapper2 .level5 .parent').on({
            mouseenter: function (elem) {
                if(prevMenuId && prevMenuItem && $(this).data('id')){
                    $('#'+prevMenuId).addClass('d-none');
                    prevMenuItem.removeClass('menu-item-green');
                    prevMenuItem.removeClass('arrow-right');
                }
                if($(this).data('id')){
                    prevMenuItem = $(this);
                    prevMenuItem.addClass('menu-item-green');
                    prevMenuId = $(this).data('id');
                    prevMenuItem.addClass('arrow-right');
                    console.log($('.arrow-right:after'));
                    $('.arrow-right:after').css('border-width', '50px');
                }
                $('#'+prevMenuId).removeClass('d-none');

            },
        });
    });

</script>


