<?php
/* @var $model \common\models\Item */
use common\models\WishList;
$wishList = WishList::getAllWish();
?>

<li class="item ">
    <div class="product-image"> <a data-pjax="0" href="<?=$model->getUrl()?>" title="<?= $model->title?>"> <img class="small-image" src="<?= $model->getOneImageUrl()?>" alt="<?= $model->title?>"></a> </div>
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

            if(mb_strlen($text, "UTF-8") > $max_lengh):
                $text_cut = mb_substr($text, 0, $max_lengh, "UTF-8");
                $text_explode = explode(" ", $text_cut);

                unset($text_explode[count($text_explode) - 1]);

                $text_implode = implode(" ", $text_explode);
                ?>

                <?= $text_implode?>... <a class="link-learn" title="Learn More" data-pjax="0" href="<?=$model->getUrl()?>"><?= Yii::t('app','Learn More')?></a>
            <?php else: ?>
                <?= $text?>

            <?php endif;?>
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
            <button class="button btn-cart ajx-cart" data-pjax="true" onclick="addToCart(<?= $model->id?>)" title="Add to Cart" type="button"><span><?= Yii::t('app','Add to Cart')?></span></button>
            <span class="add-to-links"> <a title="Add to Wishlist"  onclick="addToWishList(<?= $model->id ?>,this)" class="button link-wishlist <?=!empty($wishList) ? in_array($model->id,$wishList)?'in-wish-list':'':''?>" href=""><span><?= Yii::t('app','Add to Wishlist')?></span></a> </span> </div>
    </div>
</li>
