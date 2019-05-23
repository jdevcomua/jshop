<?php
use yii\widgets\ListView;
use common\models\Item;
use common\models\ItemCat;

/* @var $itemsDataProvider \yii\data\ActiveDataProvider */
/* @var $special Item */
/* @var $best_seller Item[] */
/* @var $deal_week Item[] */
/* @var $category_slider ItemCat[] */

$this->title = Yii::$app->name;
?>
<div class="content">
    <div id="thmg-slider-slideshow" class="thmg-slider-slideshow">
        <div class="container">
            <div id='thm_slider_wrapper' class='thm_slider_wrapper fullwidthbanner-container' >
                <div id='thm-rev-slider' class='rev_slider fullwidthabanner'>
                    <ul>
                        <li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb='images/slide-img1.jpg'><img src='images/slide-img2.jpg'  data-bgposition='left top'  data-bgfit='cover' data-bgrepeat='no-repeat' alt="slider-image1" />
                            <div class="info">
                                <div class='tp-caption ExtraLargeTitle sft  tp-resizeme ' data-x='0'  data-y='220'  data-endspeed='500'  data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2; white-space:nowrap;'><span><?= Yii::t('app','Fresh Food')?></span></div>
                                <div class='tp-caption LargeTitle sfl  tp-resizeme ' data-x='0'  data-y='300'  data-endspeed='500'  data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3; white-space:nowrap;'><?= Yii::t('app','Simply')?> <span><?= Yii::t('app','delicious')?></span></div>
                                <div class='tp-caption sfb  tp-resizeme ' data-x='0'  data-y='520'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;'><a href='#' class="buy-btn"><?= Yii::t('app','Shop Now')?></a></div>
                                <div    class='tp-caption Title sft  tp-resizeme ' data-x='0'  data-y='420'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;'><?= Yii::t('app','We supply highly quality organic products')?></div>
                            </div>
                        </li>
                        <li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb='images/slide-img3.jpg'><img src='images/slide-img3.jpg'  data-bgposition='left top'  data-bgfit='cover' data-bgrepeat='no-repeat' alt="slider-image2"  />
                            <div class="info">
                                <div class='tp-caption ExtraLargeTitle sft  tp-resizeme ' data-x='0'  data-y='220'  data-endspeed='500'  data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2; white-space:nowrap;'><span><?= Yii::t('app','Fresh Look')?></span></div>
                                <div class='tp-caption LargeTitle sfl  tp-resizeme ' data-x='0'  data-y='300'  data-endspeed='500'  data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3; white-space:nowrap;'><span>100%</span> <?= Yii::t('app','Organic')?></div>
                                <div class='tp-caption sfb  tp-resizeme ' data-x='0'  data-y='520'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;'><a href='#' class="buy-btn"><?= Yii::t('app','Shop Now')?></a></div>
                                <div    class='tp-caption Title sft  tp-resizeme ' data-x='0'  data-y='420'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;'><?= Yii::t('app','Farm Fresh Produce Right to Your Door')?></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--Category slider Start-->
    <div class="top-cate">
        <div class="featured-pro container">
            <div class="row">
                <div class="slider-items-products">
                    <div id="top-categories" class="product-flexslider hidden-buttons">
                        <div class="slider-items slider-width-col4 products-grid">
                            <?php foreach ($category_slider as $category) {?>
                            <div class="item"> <a href="#">
                                    <div class="pro-img"><img src="<?= ($category->image) ? $category->getImageUrl() : '/images/category_no_image.jpg' ?>" alt="<?= $category->title ?>">
                                        <div class="pro-info"><?= $category->title ?></div>
                                    </div>
                                </a> </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Category silder End-->

    <div id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <a href="#" data-scroll-goto="1"> <img src="images/banner-img1.jpg" alt="promotion-banner1"> </a> </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <a href="#" data-scroll-goto="2"> <img src="images/banner-img2.jpg" alt="promotion-banner2"> </a> </div>
            </div>
        </div>
    </div>
    <?php if (!empty($best_seller)) { ?>
    <!-- best Pro Slider -->
    <section class=" wow bounceInUp animated">
        <div class="best-pro slider-items-products container">
            <div class="new_title">
                <h2><?= Yii::t('app','Best Seller')?></h2>
                <h4><?= Yii::t('app','So you get to know me better')?></h4>
            </div>

            <div id="best-seller" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col4 products-grid">
                    <?php foreach ($best_seller as $item) { ?>
                    <div class="item">
                        <div class="item-inner">
                            <div class="item-img">
                                <div class="item-img-info"><a href="<?= $item->getUrl() ?>" title="<?= $item->title ?>" class="product-image">
                                        <img src="<?= ($item->images) ? $item->getOneImageUrl() : '/images/product_no_image.jpg' ?>" alt="<?= $item->title ?>">
                                    </a>
<!--                                    <div class="new-label new-top-left">Hot</div>-->
                                    <?php if($discount = $item->getMaxDiscount()) echo  ($discount->type == 1)
                                        ? '<div class="sale-label sale-top-left"> -' .$discount->value .'%</div>':
                                        '<div class="sale-label sale-top-left">' .'Sale'. '</div>' ?>
                                    <div class="item-box-hover">
                                        <div class="box-inner">
                                            <div class="product-detail-bnt"><a href="" onclick="quickView(<?= $item->id ?>); return false;" class="button detail-bnt"><span><?= Yii::t('app','Quick View')?></span></a></div>
                                            <div class="actions"><span class="add-to-links"><a href=""  onclick="addToWishList(<?= $item->id ?>); return false;" class="link-wishlist" title="<?= Yii::t('app','Add to Wishlist')?>"><span><?= Yii::t('app','Add to Wishlist')?></span></a> </span> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="add_cart">
                                    <button class="button btn-cart" type="button" onclick='addToCart(<?=$item->id?>)'><span><?= Yii::t('app','Add to Cart')?></span></button>
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="info-inner">
                                    <div class="item-title"><a href="<?= $item->getUrl()?>" title="<?= $item->title?>"><?= $item->title?></a> </div>
                                    <div class="item-content">
                                        <div class="rating">
                                            <div class="ratings">
                                                <div class="rating-box">
                                                    <div class="rating" style="width:<?= (int) $item->getAvgRating()['avg'] / 5 * 100?>%"></div>
                                                </div>
                                                <p class="rating-links"><a href="#"><?= $item->getAvgRating()['count']?> Review(s)</a> <span class="separator">|</span> <a href="#"><?= Yii::t('app','Add Review')?></a> </p>
                                            </div>
                                        </div>
                                        <div class="item-price">
                                            <div class="price-box"><span class="regular-price" ><span class="price"><?= number_format((float)$item->cost, 2, '.', '') ?></span> </span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php }?>
    <?php if (!empty($deal_week)) { ?>
    <div class="hot-section">
        <div class="container">
            <div class="row">
                <div class="ad-info">
                    <h2><?= Yii::t('app','Hurry Up!')?></h2>
                    <h3><?= Yii::t('app','Deal of the week')?></h3>
                    <h4><?= Yii::t('app','From our family farm right to your doorstep.')?></h4>
                </div>
            </div>
            <div class="row">
                <div class="hot-deal">
                    <div class="box-timer">
                        <div class="countbox_1 timer-grid"></div>
                    </div>
                    <ul class="products-grid">
                        <?php foreach ($deal_week as $item) {?>
                        <li class="item col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <div class="item-inner">
                                <div class="item-img">
                                    <div class="item-img-info"><a href="<?= $item->getUrl()?>" title="<?=$item->title?>" class="product-image">
                                            <img src="<?= ($item->images) ? $item->getOneImageUrl() : '/images/product_no_image.jpg' ?>" alt="<?=$item->title?>"></a>
<!--                                        <div class="new-label new-top-left">Hot</div>-->
                                        <?php if($discount = $item->getMaxDiscount()) echo  ($discount->type == 1)
                                            ? '<div class="sale-label sale-top-left"> -' .$discount->value .'%</div>':
                                            '<div class="sale-label sale-top-left">' .'Sale'. '</div>' ?>
                                        <div class="item-box-hover">
                                            <div class="box-inner">
                                                <div class="product-detail-bnt"><a href="" onclick="quickView(<?= $item->id ?>); return false;" class="button detail-bnt"><span><?= Yii::t('app','Quick View')?></span></a></div>
                                                <div class="actions"><span class="add-to-links"><a href=""  onclick="addToWishList(<?= $item->id ?>); return false;" class="link-wishlist" title="Add to Wishlist"><span><?= Yii::t('app','Add to Wishlist')?></span></a></span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add_cart">
                                        <button class="button btn-cart" type="button" onclick='addToCart(<?=$item->id?>)'><span><?= Yii::t('app','Add to Cart')?></span></button>

                                    </div>
                                </div>
                                <div class="item-info">
                                    <div class="info-inner">
                                        <div class="item-title"><a href="<?=$item->getUrl()?>" title="<?=$item->title?>"><?=$item->title?></a> </div>
                                        <div class="item-content">
                                            <div class="rating">
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <div class="rating" style="width:<?= (int) $item->getAvgRating()['avg'] / 5 * 100?>%"></div>
                                                    </div>
                                                    <p class="rating-links"><a href="#"><?= $item->getAvgRating()['count']?> Review(s)</a> <span class="separator">|</span> <a href="#"><?= Yii::t('app','Add Review')?></a> </p>
                                                </div>
                                            </div>
                                            <div class="item-price">
                                                <div class="price-box"><span class="regular-price"><span class="price"><?= number_format((float)$item->cost, 2, '.', '') ?></span> </span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>


    <!-- Home Lastest Blog Block -->
<!--    <div class="latest-blog wow bounceInUp animated animated container">-->
        <!--exclude For version 6 -->

        <!--For version 1,2,3,4,5,6,8 -->
<!--        <div>-->
<!--            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 blog-post">-->
<!--                <div class="blog_inner">-->
<!--                    <div class="blog-img"> <a href="blog-detail.html"> <img src="images/blog-img1.jpg" alt="blog image"> </a>-->
<!--                        <div class="mask"> <a class="info" href="blog-detail.html">Read More</a> </div>-->
<!--                    </div>-->
                    <!--blog-img-->
<!--                    <div class="blog-info">-->
<!--                        <div class="post-date">-->
<!--                            <time class="entry-date" datetime="2015-05-11T11:07:27+00:00">26 <span>June</span></time>-->
<!--                        </div>-->
<!--                        <ul class="post-meta">-->
<!--                            <li><i class="fa fa-user"></i>Posted by <a href="#">admin</a> </li>-->
<!--                            <li><i class="fa fa-comments"></i><a href="#">4 comments</a> </li>-->
<!--                        </ul>-->
<!--                        <h3><a href="blog-detail.html">Powerful and flexible premium Ecommerce themes</a></h3>-->
<!--                        <p>Fusce ac pharetra urna. Duis non lacus sit amet lacus interdum facilisis sed non est. Ut mi metus, semper eu dictum nec...</p>-->
<!--                    </div>-->
<!--                </div>-->
                <!--blog_inner-->
<!--            </div>-->
            <!--col-lg-4 col-md-4 col-xs-12 col-sm-4-->
<!--            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 blog-post">-->
<!--                <div class="blog_inner">-->
<!--                    <div class="blog-img"> <a href="blog-detail.html"> <img src="images/blog-img2.jpg" alt="blog image"> </a>-->
<!--                        <div class="mask"> <a class="info" href="blog-detail.html">Read More</a> </div>-->
<!--                    </div>-->
                    <!--blog-img-->
<!--                    <div class="blog-info">-->
<!--                        <div class="post-date">-->
<!--                            <time class="entry-date" datetime="2015-05-11T11:07:27+00:00">30 <span>June</span></time>-->
<!--                        </div>-->
<!--                        <ul class="post-meta">-->
<!--                            <li><i class="fa fa-user"></i>Posted by <a href="#">admin</a> </li>-->
<!--                            <li><i class="fa fa-comments"></i><a href="#">6 comments</a> </li>-->
<!--                        </ul>-->
<!--                        <h3><a href="blog-detail.html">Awesome template with lot's of features on the board!</a></h3>-->
<!--                        <p>Aliquam laoreet consequat malesuada. Integer vitae diam sed dolor euismod laoreet eget ac felis erat sed elit bibendum ...</p>-->
<!--                    </div>-->
<!--                </div>-->
                <!--blog_inner-->
<!--            </div>-->
<!--        </div>-->
        <!--END For version 1,2,3,4,5,6,8 -->
        <!--exclude For version 6 -->
        <!--container-->
    </div>


</div>
    <?php }?>
    <?php if (isset($special)) { ?>
<div class="mid-section">
    <div class="container">
        <div class="row">
            <h3><?= $special->title ?></h3>
            <h2><?= Yii::t('app','Special Product')?></h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="block1"> <strong><?= Yii::t('app','fresh from our farm')?></strong>
                    <p><?= Yii::t('app','Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy habitant morbi.')?></p>
                </div>
                <div class="block2"> <strong><?= Yii::t('app','100% organic Foods')?></strong>
                    <p><?= Yii::t('app','Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy habitant morbi.')?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="spl-pro"><a href="<?= $special->getUrl()?>" title="<?= $special->title?>"><img src="<?= ($special->images) ? $special->getOneImageUrl() : '/images/product_no_image.jpg'?>" alt="<?= $special->title?>"></a>
                    <div class="item-info">
                        <div class="info-inner">
                            <div class="item-title"><a href="<?= $special->getUrl()?>" title="<?= $special->title?>"><?= $special->title?></a> </div>
                            <div class="item-content">
                                <div class="rating">
                                    <div class="ratings">
                                        <div class="rating-box">
                                            <div class="rating" style="width:<?= (int) $item->getAvgRating()['avg'] / 5 * 100?>%"></div>
                                        </div>
                                        <p class="rating-links"><a href="#" ><?= $item->getAvgRating()['count']?> Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="block3"> <strong><?= Yii::t('app','Good for health')?></strong>
                    <p><?= Yii::t('app','Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy habitant morbi.')?></p>
                </div>
                <div class="block4"> <strong><?= Yii::t('app','Safe From Pesticides')?></strong>
                    <p><?= Yii::t('app','Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy habitant morbi.')?></p>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php }?>
</div>

<!--<div class="wrapper" style="margin: 0 -30px;">-->
    <!-- /templates/snippets/section-custom-top.liquid -->
<!--    <div class="section-custom-top radius-10">-->
<!--        <div class="grid">-->
<!--            <div class="grid__item section-product-new" style="padding-top: 10px;">-->
<!--                <h2 class="title">Популярные товары</h2>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="grid">-->
<!--    <div class="grid__item">-->
<!--        <section>-->
<!--            <div class="inner space-30 section-product-new">-->
<!--                <div class="arrivals ">-->
<?php
//= ListView::widget([
//                        'dataProvider' => $itemsDataProvider,
//                        'itemView' => function ($model, $key, $index, $widget) {
//                            return $this->render('_item', ['model' => $model]);
//                        },
//                        'options' => [
//                            'class' => 'grid grid-uniform',
//                        ],
//                        'itemOptions' => [
//                            'class' => 'grid__item large--one-quarter medium--one-quarter ',
//                        ],
//                        'layout' => "{items}\n{pager}",
//                    ]); ?>
<!--                </div>-->
<!--            </div>-->
<!--        </section>-->
<!--    </div>-->
<!--</div>-->