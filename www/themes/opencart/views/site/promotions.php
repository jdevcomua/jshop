<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $category \common\models\ItemCat*/
?>

<div class="content">
    <br>
    <div class="frame-inside page-category">
        <div class="container">
            <?php if (!empty($stocks)) { ?>
            <div class="">
                <ul class="animateListItems items items-catalog  table" id="items-catalog-main">

                    <?php
                    foreach ($stocks as $stock) {
                        /* @var $stock \common\models\Stock */
                        ?>
                        <li class="globalFrameProduct to-cart" style="height: 210px;width: 20% !important;">
                            <a href="<?php echo Yii::$app->urlHelper->to(['promotion/' . $stock->id]); ?>"
                               class="frame-photo-title">
                                <span class="photo-block"><span class="helper"></span><img
                                        src="<?php echo $stock->getImageUrl(); ?>"></span>
                                <span class="title" style="font-size: 14px; font-weight: bold;"><?php echo $stock->title; ?></span></a>
                                До: <?php echo $stock->date_to; ?>
                                    <div class="decor-element"
                                         style="height: 210px; width: 100%; position: absolute; right: auto; left: 0px; bottom: auto; top: 0px;">
                                    </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>
    <script type="text/javascript" src="http://active.imagecmsdemo.net/templates/active/js/cusel-min-2.5.js"></script>
</div>
<div class="h-footer"></div>
<div id="forCenter" class="forCenter d_n" data-rel="#wishListPopup"
     style="left: 0px; width: 100%; position: fixed; height: 100%; overflow-x: auto; z-index: 1105; display: block; top: 0px; background: rgba(0, 0, 0, 0.8);">
    <div class="drop drop-style drop-wishlist center active" id="wishListPopup"
         style="z-index: 1105; position: fixed; display: block; top: 20%; left: 491px;">
        <button type="button" class="icon_times_drop" data-closed="closed-js" onclick="closeWishWindow()"></button>
        <div class="drop-header">
            <div class="title">
                Выбор cписка желаний
            </div>
        </div>
        <div class="drop-content" style="overflow: hidden; padding: 0px; height: 197px; width: 300px;">
            <div class="jspContainer" style="width: 300px; height: 189px;">
                <div class="jspPane" style="padding: 0px; top: 0px; width: 300px;">
                    <div class="inside-padd">
                        <div class="horizontal-form">
                            <form method="post" action="" onsubmit="return false;">
                                <div class="frame-radio">
                                    <?php if (!empty($wishLists)) {?>
                                        <div class="frame-label active">
                                            <input class="wishRadio" type="radio" name="wishlist" value="1"
                                                   checked="checked">
                                            <select id="wishSelect"
                                                    style="width:217px;border-color: #dfdfdf;padding-left:5px;box-shadow: inset 0 1px 1px #f8f7f7;">
                                                <?php foreach ($wishLists as $list) { ?>
                                                    <option
                                                        value="<?php echo $list->id; ?>"><?php echo $list->title; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <div class="frame-label">
                                        <input class="wishRadio" type="radio" name="wishlist" value="2"
                                               data-link="[name=&quot;wishListName&quot;]">
                                        Новый
                                    </div>
                                </div>
                                <div class="frame-label">
                                    <input type="text" name="wishListName" value="" class="wish_list_name">
                                </div>
                                <div class="btn-def">
                                    <button type="submit" onclick="addToWishList()" сlass="isDrop">
                                        <span class="text-el">Добавить в список</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="drop-footer"></div>
    </div>
</div>
<div id="forCenterAuth" class="forCenter d_n" data-rel="#wishListPopup"
     style="left: 0px; width: 100%; position: fixed; height: 100%; overflow-x: auto; z-index: 1105; display: block; top: 0px; background: rgba(0, 0, 0, 0.8);">
    <div class="drop drop-style center active" id="dropAuth"
         style="z-index: 1104; position: fixed; display: block; top: 40%; left: 491px;">
        <button type="button" class="icon_times_drop" data-closed="closed-js" onclick="closeWishAuthWindow()"></button>
        <div class="drop-content t-a_c"
             style="min-height: 0px; overflow: hidden; padding: 0px; height: 75px; width: 350px;">
            <div class="jspContainer" style="width: 350px; height: 75px;">
                <div class="jspPane" style="padding: 0px; top: 0px; width: 350px;">
                    <div class="inside-padd">
                        Для того, что бы добавить товар в список желаний, Вам нужно <a
                            href="<?php echo Yii::$app->urlHelper->to(['login']); ?>">
                            <button type="button" class="d_l_1 isDrop">авторизоваться</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>