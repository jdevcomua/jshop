<?php

use yii\helpers\Html;

/* @var $item \common\models\Item */
/* @var $inCart boolean */

$this->title = $item->title;
$this->params['breadcrumbs'][] = ['label' => $item->category->title, 'url' => $item->category->getUrl()];
$this->params['breadcrumbs'][] = $this->title;

$imageUrls = $item->getImageUrl();
?>
<div>

    <div class="grid product-single">
        <div class="grid__item large--one-half text-center">
            <?php if (count($imageUrls) > 0) : ?>
                <div class="grid">
                    <div id="ProductPhoto"
                         class="product-single__photos grid__item large--four-fifths medium--four-fifths small--four-fifths right">
                        <a href="<?= $imageUrls[0] ?>" class="cloud-zoom" title="<?= $item->title ?>">
                            <img src="<?= $imageUrls[0] ?>" alt="<?= $item->title ?>" id="ProductPhotoImg">
                        </a>
                    </div>

                    <?php if (count($imageUrls) > 1) : ?>
                        <div class="left grid__item large--one-fifth medium--one-fifth small--one-fifth"
                             id="ProductThumbnails">
                            <div class="lite-carousel-play special-collection">
                                <a class="prev carousel-md" href="#">
                                    <span class="fa fa-angle-up"></span>
                                </a>
                                <div data-carousel="lite" data-visible="4">
                                    <ul class="product-single__thumbnails" id="ProductThumbs">
                                        <?php foreach ($imageUrls as $imageUrl) : ?>
                                            <li class="product__thumbnails">
                                                <a href="<?= $imageUrl ?>" class="product-single__thumbnail thumb-link"
                                                   data-rel="<?= $imageUrl ?>">
                                                    <img src="<?= $imageUrl ?>" alt="<?= $item->title ?>">
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <a class="next carousel-md" href="#">
                                    <span class="fa fa-angle-down"></span>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="grid__item large--one-half">

            <h1><?= $item->title ?></h1>
            <span class="shopify-product-reviews-badge"></span> <!-- end rating -->

            <span id="ProductPrice" class="h2">
                <span class="money"><?= $item->cost ?> грн.</span>
            </span>

            <!-- end price -->

            <p class="des-short">
                To succeed you must believe. When you believe, you will succeed. Bless up. Put it this way, it took me
                twenty five years to get these plants, twenty five years of blood sweat and tears,...
            </p> <!-- end short des -->
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
                    <label for="test" class="quantity-selector">Количество</label>
                    <input type="number" id="test" name="quantity" value="1" min="1" class="quantity-selector">
                    <?= Html::button('<i class="fa fa-shopping-cart"></i><span id="AddToCartText">В корзину</span>',
                        ['onClick' => 'addToCartFromItemPage(' . $item->id . ')', 'class' => 'btn btn--secondary']); ?>
                </div>

            <?php } ?>

            <!--<a class="btn btn--secondary wishlist  awe-button product-quick-whistlist" href="/account/login"
               data-toggle="tooltip" title="Add to whistlist">
                <i class="fa fa-heart"></i><span>В список желаний</span>
            </a>-->

        </div>
    </div>

    <div class="product-tabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs tab-v7" role="tablist">
            <li role="presentation" class="active">
                <a href="#product-detail" aria-controls="home" role="tab" data-toggle="tab">Описание</a>
            </li>

            <li role="presentation">
                <a href="#product-shipping" data-toggle="tab">Характеристики</a>
            </li>

            <li role="presentation">
                <a href="#product-reviews" aria-controls="product-reviews" role="tab" data-toggle="tab">Отзывы</a>
            </li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="product-detail">
                <div class="product-description rte">
                    <?= $item->description; ?>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="product-shipping">
                <div class="rte">
                    <b>Returns Policy</b><br>
                    <p>You may return most new, unopened items within 30 days of delivery for a full refund. We'll also
                        pay the return shipping costs if the return is a result of our error (you received an incorrect
                        or defective item, etc.).</p>

                    <p>You should expect to receive your refund within four weeks of giving your package to the return
                        shipper, however, in many cases you will receive a refund more quickly. This time period
                        includes the transit time for us to receive your return from the shipper (5 to 10 business
                        days), the time it takes us to process your return once we receive it (3 to 5 business days),
                        and the time it takes your bank to process our refund request (5 to 10 business days).</p>

                    <p>If you need to return an item, simply login to your account, view the order using the 'Complete
                        Orders' link under the My Account menu and click the Return Item(s) button. We'll notify you via
                        e-mail of your refund once we've received and processed the returned item.</p>

                    <b>Shipping</b><br>
                    <p>We can ship to virtually any address in the world. Note that there are restrictions on some
                        products, and some products cannot be shipped to international destinations.</p>

                    <p>When you place an order, we will estimate shipping and delivery dates for you based on the
                        availability of your items and the shipping options you choose. Depending on the shipping
                        provider you choose, shipping date estimates may appear on the shipping quotes page.</p>

                    <p>Please also note that the shipping rates for many items we sell are weight-based. The weight of
                        any such item can be found on its detail page. To reflect the policies of the shipping companies
                        we use, all weights will be rounded up to the next full po</p>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="product-reviews">

                <div id="shopify-product-reviews" data-id="6156548739"

                <div class="spr-container">
                    <div class="spr-header">
                        <h2 class="spr-header-title">Customer Reviews</h2>
                        <div class="spr-summary">
                            <span class="spr-summary-caption">No reviews yet</span>
                            <span class="spr-summary-actions">
                                <a href="#" class="spr-summary-actions-newreview">Write a review</a>
                            </span>
                        </div>
                    </div>

                    <div class="spr-content">
                        <div class="spr-form" id="form_6156548739" style="display: none;">
                            <form method="post" action="//productreviews.shopifycdn.com/api/reviews/create"
                                  id="new-review-form_6156548739" class="new-review-form">
                                <h3 class="spr-form-title">Write a review</h3>
                                <fieldset class="spr-form-contact">
                                    <div class="spr-form-contact-name">
                                        <label class="spr-form-label" for="review_author_6156548739">Name</label>
                                        <input class="spr-form-input spr-form-input-text " id="review_author_6156548739"
                                               type="text" name="review[author]" value="" placeholder="Enter your name">
                                    </div>
                                    <div class="spr-form-contact-email">
                                        <label class="spr-form-label" for="review_email_6156548739">Email</label>
                                        <input class="spr-form-input spr-form-input-email " id="review_email_6156548739"
                                               type="email" name="review[email]" value=""
                                               placeholder="john.smith@example.com">
                                    </div>
                                </fieldset>

                                <fieldset class="spr-form-review">

                                    <div class="spr-form-review-rating">
                                        <label class="spr-form-label" for="review[rating]">Rating</label>
                                        <div class="spr-form-input spr-starrating ">
                                            <a href="#" class="spr-icon spr-icon-star spr-icon-star-empty"
                                               data-value="1">&nbsp;</a>
                                            <a href="#" class="spr-icon spr-icon-star spr-icon-star-empty"
                                               data-value="2">&nbsp;</a>
                                            <a href="#" class="spr-icon spr-icon-star spr-icon-star-empty"
                                               data-value="3">&nbsp;</a>
                                            <a href="#" class="spr-icon spr-icon-star spr-icon-star-empty"
                                               data-value="4">&nbsp;</a>
                                            <a href="#" class="spr-icon spr-icon-star spr-icon-star-empty"
                                               data-value="5">&nbsp;</a>
                                        </div>
                                    </div>

                                    <div class="spr-form-review-title">
                                        <label class="spr-form-label" for="review_title_6156548739">Review Title</label>
                                        <input class="spr-form-input spr-form-input-text " id="review_title_6156548739"
                                               type="text" name="review[title]" value=""
                                               placeholder="Give your review a title">
                                    </div>

                                    <div class="spr-form-review-body">
                                        <label class="spr-form-label" for="review_body_6156548739">Body of Review <span
                                                class="spr-form-review-body-charactersremaining">(1500)</span></label>
                                        <div class="spr-form-input">
                                            <textarea class="spr-form-input spr-form-input-textarea "
                                                      id="review_body_6156548739" data-product-id="6156548739"
                                                      name="review[body]" rows="10"
                                                      placeholder="Write your comments here"></textarea>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="spr-form-actions">
                                    <input type="submit"
                                           class="spr-button spr-button-primary button button-primary btn btn-primary"
                                           value="Submit Review">
                                </fieldset>
                            </form>
                        </div>
                        <div class="spr-reviews" id="reviews_6156548739" style="display: none"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

