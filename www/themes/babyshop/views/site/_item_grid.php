<?php
/* @var $model \common\models\Item */
?>
<li class="item col-lg-4 col-md-3 col-sm-4 col-xs-6">
    <div class="item-inner">
        <div class="item-img">
            <div class="item-img-info"><a data-pjax="0" href="<?=$model->getUrl()?>" title="<?= $model->title?>" class="product-image">
                    <img src="<?= ($model->images) ? $model->getOneImageUrl() : '/images/product_no_image.jpg' ?>" alt="<?= $model->title?>"></a>
                <?php if($discount = $model->getMaxDiscount()) echo  ($discount->type == 1)
                    ? '<div class="sale-label sale-top-left"> -' .$discount->value .'%</div>':
                    '<div class="sale-label sale-top-left">' .'Sale'. '</div>' ?>
                <div class="item-box-hover">
                    <div class="box-inner">
                        <div class="product-detail-bnt"><a data-pjax="0" href="<?=$model->getUrl()?>" class="button detail-bnt"><span>Quick View</span></a></div>
                        <div class="actions"><span class="add-to-links"><a href="#" data-pjax="true" class="link-wishlist" title="Add to Wishlist"><span>Add to Wishlist</span></a> </span> </div>

                    </div>
                </div>
            </div>
            <div class="add_cart">
                <button class="button btn-cart" onclick="addToCart(<?= $model->id?>)" type="button"><span>Add to Cart</span></button>
            </div>
        </div>
        <div class="item-info">
            <div class="info-inner">
                <div class="item-title"><a data-pjax="0" href="<?=$model->getUrl()?>" title="<?= $model->title?>"><?= $model->title?></a> </div>
                <div class="item-content">
                    <div class="rating">
                        <div class="ratings">
                            <div class="rating-box">
                                <div class="rating" style="width:<?= (int) $model->getAvgRating()['avg'] / 5 * 100?>%"></div>
                            </div>
                            <p class="rating-links"><a data-pjax="0" href="#"><?= $model->getAvgRating()['count']?> Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                        </div>
                    </div>
                    <div class="item-price">
                        <div class="price-box"><span class="regular-price"><span class="price"><?= number_format((float)$model->cost, 2, '.', '') ?></span> </span> </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</li>
