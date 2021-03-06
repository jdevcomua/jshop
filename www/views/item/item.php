<?php

use common\models\WishList;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

/* @var $item \common\models\Item */
/* @var $inCart boolean */
/* @var $message string */
/* @var $vote \common\models\Vote */
/* @var $related \common\models\Item[] */

$this->title = !empty(Yii::$app->controller->seo->title) ? Yii::$app->controller->seo->title : $item->title;
if(isset($item->category->parent->parent))
    $this->params['breadcrumbs'][] = ['label' => $item->category->parent->parent->title, 'url' => $item->category->parent->parent->getUrl()];
if(isset($item->category->parent))
    $this->params['breadcrumbs'][] = ['label' => $item->category->parent->title, 'url' => $item->category->parent->getUrl()];
$this->params['breadcrumbs'][] = ['label' => $item->category->title, 'url' => $item->category->getUrl()];
$this->params['breadcrumbs'][] = $this->title;
$wishList = WishList::getAllWish();
$imageUrls = $item->getImageUrls();
?>
<div>
<div class="main-container col1-layout wow bounceInUp animated">
    <div class="main">
        <div class="col-main">
            <!-- Endif Next Previous Product -->
            <div class="product-view wow bounceInUp animated">
                <div id="messages_product_view"></div>
                <!--product-next-prev-->
                <div class="product-essential container">
                    <section class="content">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
                            'activeItemTemplate' => "<li class='breadcrumb-item active'>{link}</li>\n",
                            'options' =>['class' => 'breadcrumb item-breadcrumb'],
                        ]) ?>
                    </section>
                    <div class="row">
                            <!--End For version 1, 2, 6 -->
                            <!-- For version 3 -->
                            <div class="product-img-box col-lg-5 col-sm-5 col-xs-12">
                                <?php if($discount = $item->getMaxDiscount()) echo  ($discount->type == 1)
                                    ? '<div class="sale-label sale-top-left"> -' .$discount->value .'%</div>':
                                    '<div class="sale-label sale-top-left">' .'Sale'. '</div>' ?>
                                <div class="product-image">
                                    <div class="product-full"> <img id="product-zoom" src="<?=$item->getOneImageUrl()?>" data-zoom-image="<?=$item->getOneImageUrl()?>" alt="product-image"/> </div>
                                </div>
                                <!-- end: more-images -->
                            </div>
                            <!--End For version 1,2,6-->
                            <!-- For version 3 -->
                            <div class="product-shop col-lg- col-sm-7 col-xs-12">
<!--                                <div class="product-next-prev"> <a class="product-next" href="#"><span></span></a> <a class="product-prev" href="#"><span></span></a> </div>-->
                                <div class="product-name">
                                    <h1><?=$item->h1?></h1>
                                </div>
                                <div class="ratings">
                                    <div class="rating-box">
                                        <div class="rating" style="width:<?= (int) $item->getAvgRating()['avg'] / 5 * 100?>%"></div>
                                    </div>
                                    <p class="rating-links"><a id="see_reviews" href="#reviews_tabs" data-toggle="tab"><?= $item->getAvgRating()['count']?> <?=Yii::t('app','Review(s)')?></a> <span class="separator">|</span> <a id="add_reviews" href="#reviews_tabs" data-toggle="tab"><?=Yii::t('app','Add Review')?></a> </p>
                                </div>
                                <div class="price-block">
                                    <div class="price-box">
                                        <?php if($discount  = $item->existDiscount()): ?>
                                            <p class="availability in-stock">
                                                <span><?= Yii::t('app','In Stock')?></span>
                                            </p>
                                            <p class="special-price">
                                                <span class="price">Special Price</span>
                                                <span id="product-price-48" class="price">
                                                    <?= number_format((float)$item->getNewPrice(), 2, '.', '')?>
                                                </span>
                                            </p>
                                        <?php else: ?>
                                            <p class="price"> <span class="price-label"><?= Yii::t('app','Price')?></span> <span id="product-price-48" class="price"> <?=number_format((float)$item->cost, 2, '.', '') ?> </span> </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="add-to-box">
                                    <div class="add-to-cart">
                                        <div class="pull-left">
                                            <div class="custom pull-left">
                                                <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty > 1 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa fa-minus">&nbsp;</i></button>
                                                <input type="text" class="input-text qty" title="Qty" value="1" maxlength="6" id="qty" name="qty"> <?=$item->getMetricTitle()?>
                                                <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="fa fa-plus">&nbsp;</i></button>
                                            </div>
                                        </div>
                                        <button data-pjax="0" onclick="addToCart(<?= $item->id ?>)" class="button btn-cart" title="<?= Yii::t('app','Add to Cart')?>" type="button"><?= Yii::t('app','Add to Cart')?></button>
                                    </div>

                                </div>
                                <div class="short-description">
                                    <?php
                                    $text = $item->description;
                                    $max_lengh = 300;

                                    if(mb_strlen($text, "UTF-8") > $max_lengh) {
                                        $text_cut = mb_substr($text, 0, $max_lengh, "UTF-8");
                                        $text_explode = explode(" ", $text_cut);

                                        unset($text_explode[count($text_explode) - 1]);

                                        $text_implode = implode(" ", $text_explode);

                                        echo $text_implode.'... <a class="link-learn" title="'.Yii::t('app','Learn More').'" data-pjax="0" id="all_description" href="#product_tabs_description" data-toggle="tab">'.Yii::t('app','Learn More').'</a>';
                                    } else {
                                        echo $text;
                                    }
                                    ?>
                                </div>
                                <div class="email-addto-box">
                                    <ul class="add-to-links">
                                        <li> <a class="link-wishlist <?=!empty($wishList) ? in_array($item->id,$wishList)?'in-wish-list':'':''?>" href="#" data-item-id="<?= $item->id ?>"  onclick="addToWishList(<?= $item->id ?>,this); return false;" ><span><?= Yii::t('app','Add to Wishlist')?></span></a></li>
                                        <?php if(Yii::$app->user->can('admin')):?>
                                            <li>
                                                <?=Html::a('<span>'.Yii::t('app','Edit').'</span>',
                                                Yii::$app->urlHelper->to(['admin/item/update', 'id' => $item->id]),
                                                ['class' => 'edit-item-bnt', 'title'=>Yii::t('app','Edit'),'target'=>'_blank'])?>
                                            </li>
                                        <?php endif;?>
                                      </ul>
                                </div>
                                <div id="share"></div>
                            </div>
                            <!--product-shop-->
                            <!--Detail page static block for version 3-->
                    </div>
                </div>
<!--                product-essential-->
                <div class="product-collateral container">
                    <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                        <li class="active"> <a id="description_button" href="#product_tabs_description" data-toggle="tab"><?= Yii::t('app','Product Description')?></a> </li>
                        <li> <a id="reviews_button" href="#reviews_tabs" data-toggle="tab"><?= Yii::t('app','Reviews')?></a> </li>
                    </ul>
                    <div id="productTabContent" class="tab-content">
                        <div class="tab-pane  in active" id="product_tabs_description">
                            <div class="std">
                                <?= $item->description ?>
                            </div>
                        </div>
                        <div class="tab-pane  in" id="reviews_tabs">
                            <div class="woocommerce-Reviews">
                                <div>
                                    <?php \yii\widgets\Pjax::begin(['enablePushState' => false]) ?>
                                    <h2 class="woocommerce-Reviews-title"><?=$item->getAvgRating()['count']?> <?= Yii::t('app','reviews for')?> <span><?=$item->title?></span></h2>
                                    <ol class="commentlist">
                                        <?php if ($item->getAvgRating()['count'] == 0) { ?>
                                            <p><?= Yii::t('app','No reviews')?></p>
                                        <?php } else {
                                            $votes = $item->getCheckedVotes();
                                            echo \yii\widgets\ListView::widget([
                                                'dataProvider' => $votes,
                                                'itemView' => function ($model, $key, $index, $widget) {
                                                    return $this->render('_item_comment', ['model' => $model]);
                                                },
                                                'layout' => ' 
                                {items}
                                <div class="pages">
                                   {pager}
                                </div>'
                                                ]);
                                        } ?>
                                    </ol>
                                    <?php \yii\widgets\Pjax::end() ?>
                                </div>
                                <div id="add-review">
                                    <div>
                                        <div class="comment-respond">
                                            <span class="comment-reply-title"><?= Yii::t('app','Add a review')?> </span>
                                            <?php \yii\widgets\Pjax::begin() ?>
                                            <?php $form = ActiveForm::begin(['options' => ['class' => 'comment-form', 'data-pjax' => true]]); ?>
                                            <?php if(Yii::$app->user->isGuest) {?>
                                            <label><span class="required"><?= Yii::t('app','Sign up before writing a review!')?></span></label>
                                            <?php } else { ?>
                                                <p class="comment-notes comment-notes-alert"><?= $message?></p>
                                                <p class="comment-notes"><?= Yii::t('app','Required fields are marked')?> <span class="required">*</span></p>
                                                <div class="comment-form-rating">
                                                    <label id="rating"><?= Yii::t('app','Your rating')?> <span class="required">*</span></label>
                                                    <p class="stars">
                                                        <span>
                                                            <a class="star-1" onclick="setRating(1)" >1</a>
                                                            <a class="star-2" onclick="setRating(2)" >2</a>
                                                            <a class="star-3" onclick="setRating(3)" >3</a>
                                                            <a class="star-4" onclick="setRating(4)" >4</a>
                                                            <a class="star-5" onclick="setRating(5)" >5</a>
                                                            <?= $form->field($vote, 'rating')->textInput(['class'=>'hidden'])->label(false)->error(['message' => 'Put your rating, please!']) ?>
                                                        </span>
                                                    </p>
                                                </div>
                                                <p class="comment-form-comment">
                                                    <label><?= Yii::t('app','Your review')?> <span class="required">*</span></label>
                                                    <?= $form->field($vote, 'text')->textarea(['cols'=>45,'rows'=>8])->label(false) ?>
                                                </p>
<!--                                                <p class="comment-form-author">-->
<!--                                                    <label for="author">Name <span class="required">*</span></label>-->
<!--                                                    <input id="author" name="author" type="text" value="" size="30" required></p>-->
<!--                                                <p class="comment-form-email">-->
<!--                                                    <label for="email">Email <span class="required">*</span></label>-->
<!--                                                    <input id="email" name="email" type="email" value="" size="30"  required></p>-->
                                                <p class="form-submit">
                                                    <?= Html::submitButton(Yii::t('app','Submit')) ?>
                                                </p>
                                            <?php } ?>
                                            <?php ActiveForm::end(); ?>
                                            <?php \yii\widgets\Pjax::end() ?>
                                        </div><!-- #respond -->
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--product-collateral-->
                <div class="box-additional">
                    <!-- BEGIN RELATED PRODUCTS -->
                    <div class="related-pro container">
                        <div class="slider-items-products">
                            <div class="new_title center">
                                <h2><?= Yii::t('app','Related Products')?></h2>
                            </div>
                            <div id="related-slider" class="product-flexslider hidden-buttons">
                                <div class="slider-items slider-width-col4 products-grid">
                                    <?php foreach ($related as $product) { ?>
                                    <!-- Item -->
                                    <div class="item">
                                        <div class="item-inner">
                                            <div class="item-img">
                                                <div class="item-img-info"><a data-pjax="0" href="<?=$product->getUrl()?>" title="<?= $product->title?>" class="product-image">
                                                        <img src="<?= $product->getOneImageUrl()?>" alt="<?= $product->title?>"></a>
                                                    <?php if($discount = $product->getMaxDiscount()) echo  ($discount->type == 1)
                                                        ? '<div class="sale-label sale-top-left"> -' .$discount->value .'%</div>':
                                                        '<div class="sale-label sale-top-left">' .'Sale'. '</div>' ?>
                                                    <div class="item-box-hover">
                                                        <div class="box-inner">
                                                            <div class="product-detail-bnt"><a  href=""  onclick="quickView(<?= $product->id ?>); return false;" class="button detail-bnt"><span>Quick View</span></a></div>
                                                            <div class="actions"><span class="add-to-links"><a href="" data-item-id="<?= $product->id ?>" onclick="addToWishList(<?= $product->id ?>,this); return false;" class="link-wishlist <?=!empty($wishList) ? in_array($item->id,$wishList)?'in-wish-list':'':''?>" title="<?=Yii::t('app','Add to Wishlist')?>"><span><?=Yii::t('app','Add to Wishlist')?></span></a> </span> </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add_cart">
                                                    <button class="button btn-cart" onclick="addToCart(<?= $product->id?>)" type="button"><span><?= Yii::t('app','Add to Cart')?></span></button>
                                                </div>
                                            </div>
                                            <div class="item-info">
                                                <div class="info-inner">
                                                    <div class="item-title"><a data-pjax="0" href="<?=$product->getUrl()?>" title="<?= $product->title?>"><?= $product->title?></a> </div>
                                                    <div class="item-content">
                                                        <div class="rating">
                                                            <div class="ratings">
                                                                <div class="rating-box">
                                                                    <div class="rating" style="width:<?= (int) $product->getAvgRating()['avg'] / 5 * 100?>%"></div>
                                                                </div>
                                                                <p class="rating-links"><a data-pjax="0" href="#"><?= $product->getAvgRating()['count']?><?= Yii::t('app','Review(s)')?> </a> <span class="separator">|</span> <a href="#"><?= Yii::t('app','Add Review')?></a> </p>
                                                            </div>
                                                        </div>
                                                        <div class="item-price">
                                                            <div class="price-box"><span class="regular-price"><span class="price"><?= number_format((float)$product->cost, 2, '.', '') ?></span> </span> </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Item -->
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end related product -->

                </div>
                <!-- end related product -->
            </div>
            <!--box-additional-->
            <!--product-view-->
        </div>
    </div>
    <!--col-main-->
</div>

</div>