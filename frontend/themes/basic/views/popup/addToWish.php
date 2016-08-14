<?php
?>
<div class="jspContainer" style="width: 300px; height: 189px;">
    <div class="jspPane" style="padding: 0px; top: 0px; width: 300px;">
        <div class="inside-padd">
            <div class="horizontal-form">
                <form method="post" action="" onsubmit="return false;">
                    <div class="frame-radio">
                        <?php if (!empty($wishLists)) { ?>
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