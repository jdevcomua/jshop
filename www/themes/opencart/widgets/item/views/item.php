<?php

use common\models\Item;

/**@var Item $model*/
/**@var int $count*/
?>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="product-thumb transition">
        <div class="image">
            <a href="<?= $model->getUrl() ?>">
                <img src="<?= array_shift($model->getImageUrls(Item::IMAGE_SMALL)) ?>" alt="<?= $model->title ?>" title="<?= $model->title ?>" class="img-responsive">
            </a>
        </div>
        <div class="caption">
            <h4><a href="<?= $model->getUrl() ?>"><?= $model->title ?></a></h4>
            <div class="item-description"><?= $model->description ?></div>
            <p class="price">
                <?php if ($model->existDiscount()): ?>
                    <span class="price-new"><?= $model->getNewPrice()?></span>
                    <span class="price-old"><?= $model->cost ?></span>
                <?php else :?>
                    <?= $model->cost ?>
                <?php endif?>
            </p>
        </div>
        <div class="button-group">
            <button type="button" data-id="<?= $model->id?>" class="cart-add">
                <i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span>
            </button>
            <button type="button" data-toggle="tooltip" title=""
                    onclick="addToWishList();" data-original-title="Add to Wish List"><i
                    class="fa fa-heart"></i></button>
            <button type="button" data-toggle="tooltip" title=""
                    onclick="compare.add(&#39;43&#39;);" data-original-title="Compare this Product">
                <i class="fa fa-exchange"></i></button>
        </div>
    </div>
</div>