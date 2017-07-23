<?php
/* @var $model \common\models\Item */
?>
<div class="product-container">
    <div class="product-header">
        <h4 class="product-name">
            <a href="<?= $model->getUrl() ?>"
               title="Baby Einstein Take Along"><?= $model->getTitle() ?></a>
        </h4><!-- /.product-product -->
        <span class="spr-badge" id="spr_badge_6156548739" data-rating="0.0">
            <span class="spr-starrating spr-badge-starrating">
                <i class="spr-icon spr-icon-star-empty" style="color: #f5ab23;"></i>
                <i class="spr-icon spr-icon-star-empty" style="color: #f5ab23;"></i>
                <i class="spr-icon spr-icon-star-empty" style="color: #f5ab23;"></i>
                <i class="spr-icon spr-icon-star-empty" style="color: #f5ab23;"></i>
                <i class="spr-icon spr-icon-star-empty" style="color: #f5ab23;"></i>
            </span>
            <span class="spr-badge-caption">No reviews</span>
        </span>
        <!-- end rating -->
    </div>
    <div class="product-image ">
        <div class="product-thumbnail">
            <a href="<?= $model->getUrl() ?>" title="">
                <img class="product-featured-image" src="<?= $model->getOneImageUrl() ?>"
                     alt="<?= $model->getTitle() ?>">
            </a>
        </div><!-- /.product-thumbnail -->
    </div><!-- /.product-image -->

    <div class="product-meta">
        <?php if (Yii::$app->cart->checkItemInCart($model->id)) { ?>
            <a href="<?= Yii::$app->urlHelper->to(['cart/index']) ?>">
                <button type="button" class="in-cart" title="В корзине">
                    <span class="fa fa-shopping-cart"></span>
                </button>
            </a>
        <?php } else { ?>
            <form id="toCart-<?php echo $model->id ?>" class="add-to-cart">
                <button type="button" class="btn" title="Купить" onclick="addToCart(<?= $model->id ?>)">
                    <span class="fa fa-shopping-cart"></span>
                </button>
            </form>

            <button id="inCart-<?php echo $model->id ?>" type="button" class="in-cart d_n" title="В корзине">
                <span class="fa fa-shopping-cart"></span>
            </button>
        <?php } ?>


        <div class="product-price">
            <span class="amout">
                <span class="money"><?= $model->cost ?> грн.</span>
            </span>
        </div><!-- /.product-price -->
    </div><!-- /.product-meta -->

    <div class="product-actions">
        <a class="btn btn--secondary wishlist  awe-button product-quick-whistlist" href="/account/login"
           data-toggle="tooltip" title="Add to whistlist">
            <i class="fa fa-heart"></i><span>Add to Wishlist</span>
        </a>

        <a href="/collections/air-storm/products/baby-einstein-take-along"
           data-id="baby-einstein-take-along" class="btn product-quick-view btn-quickview"
           title="Quickview">
            <i class="fa fa-eye"></i>
        </a>
    </div>

</div> <!-- product-container -->
