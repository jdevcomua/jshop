<?php

use yii\widgets\ListView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use www\themes\babyshop\QuickViewAsset;
use common\components\Theme;

/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $category \common\models\ItemCat */
/* @var $modalModel \common\models\Item */
/* @var $chars array */
/* @var $selected array */
/* @var $mapData array */
/* @var $sort string */
/* @var $minCost float */
/* @var $maxCost float */
/* @var $countCosts string[] */


$this->title = $category->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="main-container col2-left-layout bounceInUp animated">
    <!-- For version 1, 2, 3, 8 -->
    <!-- For version 1, 2, 3 -->
    <div class="container">
        <div class="row">
            <div class="col-main col-sm-9 col-sm-push-3 product-grid">
                <div class="pro-coloumn">
                    <div class="category-description std">
                        <div class="slider-items-products">
                            <div id="category-desc-slider" class="product-flexslider hidden-buttons">
                                <div class="slider-items slider-width-col1 owl-carousel owl-theme">

                                    <!-- Item -->
                                    <div class="item"> <a href="#"><img alt="" src="/images/category-img1.jpg"></a>
                                        <div class="cat-img-title cat-bg cat-box">
                                            <div class="small-tag"><?= Yii::t('app','Season')?> 2018</div>
                                            <h2 class="cat-heading"><?= Yii::t('app','Organic')?> <span><?= Yii::t('app','World')?></span></h2>
                                            <p><?= Yii::t('app','GET 40% OFF &sdot; Free Delivery')?> </p>
                                        </div>
                                    </div>
                                    <!-- End Item -->

                                    <!-- Item -->
                                    <div class="item"> <a href="#"><img alt="" src="/images/category-img2.jpg"></a>
                                        <div class="cat-img-title cat-bg cat-box">
                                            <div class="small-tag"><?= Yii::t('app','Green World')?></div>
                                            <h2 class="cat-heading"><?= Yii::t('app','Vegetable')?> <span><?= Yii::t('app','Sale')?></span></h2>
                                            <p><?= Yii::t('app','Save 70% on all items')?></p>
                                        </div>
                                        <!-- End Item -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php Pjax::begin(['id'=>'itemList']) ?>
                    <?php if (Yii::$app->session->get('listType') == 'grid') {
                        $sorter = '<div class="sorter">
                                <div class="view-mode"> <span title="Grid" 
                                class="button button-active button-grid">&nbsp;</span>
                                <a href="" data-pjax="true" onclick="setListType(\'list\')" title="List" class="button-list">&nbsp;</a> </div>
                            </div>';
                        $listBegin = '<ul class="products-grid">';
                        $listEnd = '</ul>';
                    } else {
                        $sorter = '<div class="sorter">
                                <div class="view-mode"> 
                                <a href="" data-pjax="true" onclick="setListType(\'grid\')" title="Grid" class="button-grid">&nbsp;</a> 
                                <span title="List" class="button button-active button-list">&nbsp;</span></div>
                            </div>' ;
                        $listBegin = '<ol class="products-list" id="products-list">';
                        $listEnd = '</ol>';
                    }?>
                    <article>
                                <?= ListView::widget([
                                    'dataProvider' => $dataProvider,
                                    'itemView' => function ($model, $key, $index, $widget) {
                                        return $this->render('_item_' . Yii::$app->session->get('listType'), ['model' => $model]);
                                    },
                                    'layout' => '
                        <div class="toolbar">   
                           ' . $sorter . '
                            <div class="sort-by">
                                <label class="left">'. Yii::t('app', 'Sort By') .': </label>
                                <ul>
                                    <li><a href="" data-pjax="true" onclick="setSort(\''.Yii::$app->session->get('sort').'\')">'.Theme::getSortName()[Yii::$app->session->get('sort')].'<span class="right-arrow"></span></a>
                                        <ul>
                                            '.Theme::getSort(Yii::$app->session->get('sort')).'
                                           
                                        </ul>
                                    </li>
                                </ul>
                                <a class="button-asc left" href="" onclick="setDefaultSort()" title="Set Descending Direction"><span>X</span></a> </div>
                            <div class="pager">
                                <div class="limiter">
                                    <label>'. Yii::t('app', 'View').' : </label>
                                    <ul>
                                        <li><a href=""  data-pjax="true" onclick="setPerPage('.Yii::$app->session->get('page').')">' . Theme::getParam(Yii::$app->session->get('page')) . '<span class="right-arrow"></span></a>
                                            <ul>
                                                '.Theme::getPagination(Yii::$app->session->get('page')).'
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pages">
                                   {pager}
                                </div>
                            </div>
                        </div>
                        <div class="category-products">
                            '.$listBegin.'
                                {items}
                            '.$listEnd.'
                        </div>
                        <div class="toolbar bottom">
                            <div class="display-product-option">
                                <div class="pages">
                                    {pager}
                                </div>
                                <div class="product-option-right">
                                    <div class="sort-by">
                                        <label class="left">'. Yii::t('app', 'Sort By') .': </label>
                                        <ul>
                                            <li><a href="" data-pjax="true" onclick="setSort(\''.Yii::$app->session->get('sort').'\')">'.Theme::getSortName()[Yii::$app->session->get('sort')].'<span class="right-arrow"></span></a>
                                                <ul>
                                                    '.Theme::getSort(Yii::$app->session->get('sort')).'
                                                   
                                                </ul>
                                            </li>
                                        </ul>
                                        <a class="button-asc left default-sort" href="" onclick="setDefaultSort()" title="Set Descending Direction"><span>X</span></a> </div>
                                    <div class="pager">
                                        <div class="limiter">
                                            <label>'. Yii::t('app', 'View') .': </label>
                                            <ul>
                                                <li><a href="" onclick="setPerPage('.Yii::$app->session->get('page').')">' . Theme::getParam(Yii::$app->session->get('page')) . '<span class="right-arrow"></span></a>
                                                    <ul>
                                                        '.Theme::getPagination(Yii::$app->session->get('page')).'
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>',
                                    'pager' => [
                                        'hideOnSinglePage' => false,
                                        'disabledListItemSubTagOptions' => ['tag' => 'a']
                                    ],
                                    'emptyText' =>  '<div class="toolbar">   
                           ' . $sorter . '
                            <div class="sort-by">
                                <label class="left">'. Yii::t('app', 'Sort By').': </label>
                                <ul>
                                    <li><a href="" data-pjax="true" onclick="setSort(\''.Yii::$app->session->get('sort').'\')">'.Theme::getSortName()[Yii::$app->session->get('sort')].'<span class="right-arrow"></span></a>
                                        <ul>
                                            '.Theme::getSort(Yii::$app->session->get('sort')).'
                                           
                                        </ul>
                                    </li>
                                </ul>
                                <a class="button-asc left" href="" onclick="setDefaultSort()" title="Set Descending Direction"><span>X</span></a> </div>
                            <div class="pager">
                                <div class="limiter">
                                    <label>'. Yii::t('app', 'View').': </label>
                                    <ul>
                                        <li><a href=""  data-pjax="true" onclick="setPerPage('.Yii::$app->session->get('page').')">' . Theme::getParam(Yii::$app->session->get('page')) . '<span class="right-arrow"></span></a>
                                            <ul>
                                                '.Theme::getPagination(Yii::$app->session->get('page')).'
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pages">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="category-products">
                           <p align="center">'. Yii::t('app', 'No items').' ...</p>
                        </div>
                        <div class="toolbar bottom">
                            <div class="display-product-option">
                                <div class="pages">
                                  
                                </div>
                                <div class="product-option-right">
                                    <div class="sort-by">
                                        <label class="left">'. Yii::t('app', 'Sort By').': </label>
                                        <ul>
                                            <li><a href="" data-pjax="true" onclick="setSort(\''.Yii::$app->session->get('sort').'\')">'.Theme::getSortName()[Yii::$app->session->get('sort')].'<span class="right-arrow"></span></a>
                                                <ul>
                                                    '.Theme::getSort(Yii::$app->session->get('sort')).'
                                                   
                                                </ul>
                                            </li>
                                        </ul>
                                        <a class="button-asc left default-sort" href="" onclick="setDefaultSort()" title="Set Descending Direction"><span>X</span></a> </div>
                                    <div class="pager">
                                        <div class="limiter">
                                            <label>'. Yii::t('app', 'View').' : </label>
                                            <ul>
                                                <li><a href="" onclick="setPerPage('.Yii::$app->session->get('page').')">' . Theme::getParam(Yii::$app->session->get('page')) . '<span class="right-arrow"></span></a>
                                                    <ul>
                                                        '.Theme::getPagination(Yii::$app->session->get('page')).'
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>'
                                ]); ?>
                    </article>
                    <?php Pjax::end() ?>
                </div>
                <!--	///*///======    End article  ========= //*/// -->
            </div>
            <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9 wow bounceInUp animated">
                <!-- BEGIN SIDE-NAV-CATEGORY -->
                <div class="side-nav-categories">
                    <div class="block-title"> <?= Yii::t('app','Categories')?> </div>
                    <!--block-title-->
                    <!-- BEGIN BOX-CATEGORY -->
                    <?= \www\widgets\category\CategoriesView::widget(['view' => 'grid-menu']) ?>
                    <!--box-content box-category-->
                </div>
                <!--side-nav-categories-->
                <div class="block block-layered-nav">
                    <div class="block-title"> <?= Yii::t('app','Shop by')?> </div>
                    <div class="block-content">
                        <p class="block-subtitle"><?= Yii::t('app','Shopping Options')?></p>
                        <dl id="narrow-by-list">
                            <dt class="odd"><?= Yii::t('app','Price')?></dt>
                            <dd class="odd">
                                <ol>
                                    <li> <a class="price-range" onclick="setPriceRange(<?=$minCost?>,<?=$maxCost?>)" href=""><?= Yii::t('app','All')?></a> </li>
                                    <li> <a class="price-range" onclick="setPriceRange(0,99.99)" href=""><span class="price">0.00</span> - <span class="price">99.99</span></a> (<?= $countCosts[0] ?>) </li>
                                    <li> <a class="price-range" onclick="setPriceRange(100,499.99)" href=""><span class="price">100.00</span> - <span class="price">499.99</span></a> (<?= $countCosts[1] ?>) </li>
                                    <li> <a class="price-range" onclick="setPriceRange(500,999.99)" href=""><span class="price">500.00</span> - <span class="price">999.99</span></a> (<?= $countCosts[2] ?>) </li>
                                    <li> <a class="price-range" onclick="setPriceRange(1000,-1)" href=""><span class="price">1000.00</span> <?= Yii::t('app','and above')?> </a> (<?= $countCosts[3] ?>) </li>
                                </ol>
                            </dd>
<!--                            <dt class="even">Manufacturer</dt>-->
<!--                            <dd class="even">-->
<!--                                <ol>-->
<!--                                    <li> <a href="#">TheBrand</a> (9) </li>-->
<!--                                    <li> <a href="#">Company</a> (4) </li>-->
<!--                                    <li> <a href="#">LogoFashion</a> (1) </li>-->
<!--                                </ol>-->
<!--                            </dd>-->
<!--                            <dt class="odd">Color</dt>-->
<!--                            <dd class="odd">-->
<!--                                <ol>-->
<!--                                    <li> <a href="#">Green</a> (1) </li>-->
<!--                                    <li> <a href="#">White</a> (5) </li>-->
<!--                                    <li> <a href="#">Black</a> (5) </li>-->
<!--                                    <li> <a href="#">Gray</a> (4) </li>-->
<!--                                    <li> <a href="#">Dark Gray</a> (3) </li>-->
<!--                                </ol>-->
<!--                            </dd>-->
<!--                            <dt class="last even">Size</dt>-->
<!--                            <dd class="last even">-->
<!--                                <ol>-->
<!--                                    <li> <a href="#">Small</a> (6) </li>-->
<!--                                    <li> <a href="#">Medium</a> (6) </li>-->
<!--                                    <li> <a href="#">Large</a> (4) </li>-->
<!--                                </ol>-->
<!--                            </dd>-->
                        </dl>
                    </div>
                </div>
                <div class="custom-slider">
                    <div>
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li class="active" data-target="#carousel-example-generic" data-slide-to="0"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active"><img src="/images/slide2.jpg" alt="slide3">
                                    <div class="carousel-caption">
                                        <h4><?= Yii::t('app','Fruit Shop')?></h4>
                                        <h3><a title=" Sample Product" href="product-detail.html"><?= Yii::t('app','Up to 70% Off')?></a></h3>
                                        <p><?= Yii::t('app','Lorem ipsum dolor sit amet, consectetur adipiscing elit.')?></p>
                                        <a class="link" href="#"><?= Yii::t('app','Buy Now')?></a></div>
                                </div>
                                <div class="item"><img src="/images/slide3.jpg" alt="slide1">
                                    <div class="carousel-caption">
                                        <h4><?= Yii::t('app','Black Grapes')?></h4>
                                        <h3><a title=" Sample Product" href="product-detail.html"><?= Yii::t('app','Mega Sale')?></a></h3>
                                        <p><?= Yii::t('app','Lorem ipsum dolor sit amet, consectetur adipiscing elit.')?></p>
                                        <a class="link" href="#"><?= Yii::t('app','Buy Now')?></a>
                                    </div>
                                </div>
                                <div class="item"><img src="/images/slide1.jpg" alt="slide2">
                                    <div class="carousel-caption">
                                        <h4><?= Yii::t('app','Food Farm')?></h4>
                                        <h3><a title=" Sample Product" href="product-detail.html"><?= Yii::t('app','Up to 50% Off')?></a></h3>
                                        <p><?= Yii::t('app','Lorem ipsum dolor sit amet, consectetur adipiscing elit.')?></p>
                                        <a class="link" href="#"><?= Yii::t('app','Buy Now')?></a>
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> <span class="sr-only"><?= Yii::t('app','Previous')?></span> </a> <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> <span class="sr-only"><?= Yii::t('app','Next')?></span> </a></div>
                    </div>
                </div>

                <div class="block block-list block-cart">
                    <div class="block-title"> <?=Yii::t('app','My Cart')?> </div>
                    <div class="block-content">
                        <?php Pjax::begin(['id'=>'cart_cat']) ?>
                        <div class="summary">
                            <p class="amount"><?=Yii::t('app','There is')?> <a href="<?=Url::toRoute('cart/index')?>"><?=Yii::$app->cart->getCount()?> <?= Yii::t('app','item')?> </a><?= Yii::t('app','in your cart.')?> </p>
                            <p class="subtotal"> <span class="label"><?=Yii::t('app','Cart Subtotal')?> :</span> <span class="price"><?= number_format((float)Yii::$app->cart->getSum(), 2, '.', '');  ?></span> </p>
                        </div>
                        <div class="ajax-checkout">
                            <button type="button" title="Checkout" class="button button-checkout" onClick="window.location='<?= Url::toRoute('cart/index')?>'"> <span><?= Yii::t('app','Checkout')?></span> </button>
                        </div>

                        <?php if(!Yii::$app->cart->isEmpty()) { ?>
                            <p class="block-subtitle"><?= Yii::t('app','Recently added item(s)')?></p>
                            <ul id="cart-sidebar1" class="mini-products-list">
                                <?php foreach (Yii::$app->cart->getModels() as $key => $cartElement) {?>
                                    <li class="item <?=($key == count(Yii::$app->cart->getModels())-1) ? 'last1' : ''?>">
                                        <div class="item-inner"><a data-pjax=0 class="product-image" title="<?= $cartElement->model->title?>"
                                                                   href="<?= $cartElement->model->getUrl() ?>"><img alt="<?= $cartElement->model->title?>"
                                                                                                                    src="<?= ($cartElement->model->images) ? (is_array($urls = $cartElement->model->getOneImageUrl()) ? $urls[0] : $urls) : Yii::$app->params['defaultKitImage'] ?>"></a>
                                            <div class="product-details">

                                                <div class="access"><a data-reload = "1" href="" class="btn-remove1 cart__remove" title="Remove This Item"  data-id="<?= $cartElement->model->getId(); ?>" data-type="<?= $cartElement->model->getType(); ?>"><?= Yii::t('app','Remove')?></a></div>
                                                <!--access-->
                                                <strong><?= $cartElement->count ?></strong> <?= $cartElement->model->getMetricTitle()?> X <span class="price"><?= number_format((float) $cartElement->model->getNewPrice(), 2, '.', '') ?></span>
                                                <p class="product-name"><a data-pjax=0 href="<?= $cartElement->model->getUrl() ?>"><?= $cartElement->model->title ?></a></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php }?>
                            </ul>
                        <?php } ?>
                        <?php Pjax::end()?>
                    </div>
                </div>
<!--                <div class="block block-compare">-->
<!--                    <div class="block-title"> Compare Products </div>-->
<!--                    <div class="block-content">-->
<!--                        <ol id="compare-items">-->
<!--                            <li class="item odd">-->
<!--                                <a href="#" class="btn-re   move1" onClick="#"></a>-->
<!--                                <a class="product-name" href="#">Fresh Organic Mustard Leaves </a>            </li>-->
<!--                            <li class="item odd">-->
<!--                                <a href="#" class="btn-remove1" onClick="#"></a>-->
<!--                                <a class="product-name" href="#">Fresh Organic Mustard Leaves </a>            </li>-->
<!--                            <li class="item odd">-->
<!--                                <a href="#" class="btn-remove1" onClick="#"></a>-->
<!--                                <a class="product-name" href="#">Fresh Organic Mustard Leaves </a>            </li>-->
<!--                            <li class="item odd">-->
<!--                                <a href="#" class="btn-remove1" onClick="#"></a>-->
<!--                                <a class="product-name" href="#">Fresh Organic Mustard Leaves </a>            </li>-->
<!--                        </ol>-->
<!---->
<!--                        <div class="ajax-checkout">-->
<!--                            <button type="button" title="Compare" class="button button-compare" onClick="#"><span>Compare</span></button>-->
<!---->
<!--                        </div><!--ajax-checkout-->
<!--                    </div>-->
<!--                    <!--block-content-->
<!--                </div>-->
                <!--block block-list block-compare-->
            </aside>
            <!--col-right sidebar-->
        </div>
        <!--row-->
    </div>
    <!--container-->
</section>

