<?php
/**
 * @var $model \common\models\Wish;
 */
?>
<tr id="item_32" class="">
    <td class="wishlist-cell0 customer-wishlist-item-image"><a class="product-image" href="<?=$model->item->getUrl()?>" title="<?=$model->item->title?>"> <img src="<?= ($model->item->images) ? $model->item->getOneImageUrl() : '/images/product_no_image.jpg'?>" width="80" height="80" alt="<?=$model->item->title?>"> </a></td>
    <td class="wishlist-cell1 customer-wishlist-item-info"><h3 class="product-name"><a href="<?=$model->item->getUrl()?>" title="<?=$model->item->title?>"><?=$model->item->title?></a></h3>
        <div class="description std">
            <div class="inner">
                <?php
                $text = $model->item->description;
                $max_len = 100;

                if(mb_strlen($text, "UTF-8") > $max_len) {
                    $text_cut = mb_substr($text, 0, $max_len, "UTF-8");
                    $text_explode = explode(" ", $text_cut);

                    unset($text_explode[count($text_explode) - 1]);

                    $text_implode = implode(" ", $text_explode);

                    echo $text_implode.'... <a class="link-learn" title="Learn More" data-pjax="0" href="'.$model->item->getUrl().'">Learn More</a>';
                } else {
                    echo $text;
                }
                ?>
            </div>
        </div>
    <td class="wishlist-cell2 customer-wishlist-item-quantity" data-rwd-label="Quantity"><div class="cart-cell">
            <div class="add-to-cart-alt">
                <input type="text" pattern="\d*" class="input-text qty validate-not-negative-number" name="qty[<?=$model->item->id?>]" id="qty-<?= $model->item->id ?>" value="1">
            </div>
        </div>
    </td>
    <td class="wishlist-cell3 customer-wishlist-item-price" data-rwd-label="Price"><div class="cart-cell">
            <div class="price-box"> <span class="regular-price" id="product-price-2"> <span class="price"><?=number_format((float)$model->item->getNewPrice(), 2, '.', '') ?></span> </span> </div>
        </div>
    </td>
    <td class="wishlist-cell4 customer-wishlist-item-cart"><div class="cart-cell">
            <button type="button" title="Add to Cart" onClick="addToCart(<?=$model->item->id?>);" class="button btn-cart"><span><span>Add to Cart</span></span></button>
        </div>
    <td class="wishlist-cell5 customer-wishlist-item-remove last"><a href="" onClick="removeWish(<?=$model->id?>);" title="Clear Cart" class="remove-item"><span><span></span></span></a></td>
</tr>
