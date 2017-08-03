<?php
/* @var $model \common\models\Item */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $inCart boolean */

$imageUrls = $model->getImageUrl();
?>
<div class="quickview-product">
    <div class="content product-single">
        <div class="row">
            <?php if (count($imageUrls) > 0) : ?>
                <div class="col-xs-6">
                    <div class="product-media thumbnai-left">
                        <div class="featured-image product-single-photos">
                            <a title="<?= $model->title ?>" class="product-photo" href="<?= $model->getUrl() ?>">
                                <img src="<?= $imageUrls[0] ?>" alt="<?= $model->title ?>" id="ProductPhotoImg">
                            </a>
                        </div>
                        <?php if (count($imageUrls) > 1) : ?>
                            <div class="more-views owl-carousel-play margin-top-10">
                                <div class="owl-carousel owl-theme" style="display: block; opacity: 1;">
                                    <div class="owl-wrapper-outer">
                                        <div class="owl-wrapper" style="width: 408px; left: 0; display: block;">
                                            <?php foreach ($imageUrls as $imageUrl) : ?>
                                                <div class="owl-item" style="width: 68px;">
                                                    <div class="item">
                                                        <a href="javascript:void(0)" data-image="<?= $imageUrl ?>">
                                                            <img src="<?= $imageUrl ?>">
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>
                                    <div class="owl-controls clickable" style="display: none;">
                                        <div class="owl-pagination">
                                            <div class="owl-page"><span class=""></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="<?= count($imageUrls) > 0 ? 'col-xs-6' : 'col-xs-12' ?>">
                <div class="product-shop product-info-main">
                    <div class="product-item">

                        <h2 class="product-name">
                            <a href="<?= $model->getUrl() ?>"><?= $model->title ?></a>
                        </h2>

                        <div class="details clearfix">
                            <span id="ProductPrice" class="cost-block">
                                <span class="money h2"><?= $model->cost ?> грн.</span>
                                <span class="product-id">Код товара: <?= $model->id ?></span>
                            </span>

                            <hr>

                            <?php if ($inCart) { ?>
                                <a id="inCart" href="<?php echo Yii::$app->urlHelper->to(['cart/index']) ?>">
                                    <button type="button" class="btn btn--secondary">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span id="AddToCartText">В корзине</span>
                                    </button>
                                </a>
                            <?php } else { ?>
                                <a id="inCart" class="d_n" href="<?php echo Yii::$app->urlHelper->to(['cart/index']) ?>">
                                    <button type="button" class="btn btn--secondary">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span id="AddToCartText">В корзине</span>
                                    </button>
                                </a>
                                <div id="toCart">
                                    <label for="test" class="quantity-selector">Количество</label><br>
                                    <p><input type="number" id="test" name="quantity" value="1" min="1" class="quantity-selector"></p>
                                    <?= Html::button('<i class="fa fa-shopping-cart"></i><span id="AddToCartText">В корзину</span>',
                                        ['onClick' => 'addToCartFromItemPage(' . $model->id . ')', 'class' => 'btn btn--secondary']); ?>
                                </div>
                            <?php } ?>

                            <br>
                            <br>
                            <a href="<?= Url::to(['/site/delivery']) ?>"><h6>Доставка новой почтой</h6></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
