<?php
/* @var $model \common\models\Item */
?>

<li class="item ">
    <div class="product-image"> <a data-pjax="0" href="<?=$model->getUrl()?>" title="<?= $model->title?>"> <img class="small-image" src="<?= ($model->images) ? $model->getOneImageUrl() : '/images/product_no_image.jpg' ?>" alt="<?= $model->title?>"></a> </div>
    <div class="product-shop">
        <h2 class="product-name"><a data-pjax="0" href="<?=$model->getUrl()?>" title="<?= $model->title?>"><?= $model->title?></a></h2>
        <div class="ratings">
            <div class="rating-box">
                <div class="rating" style="width:<?= (int) $model->getAvgRating()['avg'] / 5 * 100?>%"></div>
            </div>
            <p class="rating-links"><a href="#"><?= $model->getAvgRating()['count']?> Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
        </div>
        <div class="desc std">
            <?php
            $text = $model->description;
            $max_lengh = 300;

            if(mb_strlen($text, "UTF-8") > $max_lengh) {
                $text_cut = mb_substr($text, 0, $max_lengh, "UTF-8");
                $text_explode = explode(" ", $text_cut);

                unset($text_explode[count($text_explode) - 1]);

                $text_implode = implode(" ", $text_explode);

                echo $text_implode.'... <a class="link-learn" title="Learn More" data-pjax="0" href="'.$model->getUrl().'">Learn More</a>';
            } else {
                echo $text;
            }
            ?>
        </div>
        <div class="price-box">
            <?php if($model->existDiscount()) {?>
                <p class="old-price"> <span class="price-label"></span> <span id="old-price-212" class="price"> <?= number_format((float)$model->cost, 2, '.', '') ?> </span> </p>
                <p class="special-price"> <span class="price-label"></span> <span id="product-price-212" class="price"> <?= number_format((float)$model->getNewPrice(), 2, '.', '') ?> </span> </p>
            <? } else {?>
               <span class="regular-price" id="product-price-159"> <span class="price"><?= number_format((float)$model->cost, 2, '.', '')?></span> </span>
            <?php }?>
        </div>
        <div class="actions">
            <button class="button btn-cart ajx-cart" data-pjax="true" onclick="addToCart(<?= $model->id?>)" title="Add to Cart" type="button"><span>Add to Cart</span></button>
            <span class="add-to-links"> <a title="Add to Wishlist"  onclick="addToWishList(<?= $model->id ?>)" class="button link-wishlist" href=""><span>Add to Wishlist</span></a> </span> </div>
    </div>
</li>
