<?php

use common\models\Slider;
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use \common\models\ItemCat;
use www\themes\babyshop\QuickViewAsset;
use common\components\Theme;
use lavrentiev\widgets\toastr\Notification;

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
/* @var $slider Slider[] */

$this->title = $category->title;
if(isset($category->parent->parent))
    $this->params['breadcrumbs'][] = ['label' => $category->parent->parent->title, 'url' => $category->parent->parent->getUrl()];
if(isset($category->parent))
    $this->params['breadcrumbs'][] = ['label' => $category->parent->title, 'url' => $category->parent->getUrl()];
$this->params['breadcrumbs'][] = $category->title;
?>

<section class="main-container col2-left-layout bounceInUp animated">
    <?php
    if($category->title == ItemCat::ALCOHOL || $category->title == ItemCat::TOBACOO):
        ?>
        <div id='forAdults'>
        <?=Notification::widget([
            'type' => Notification::TYPE_SUCCESS,
            'title' => '18+',
            'message' => Yii::t('app','Категория только для совершеннолетних'),
            'options' => [
                "closeButton" => false,
                "debug" => false,
                "newestOnTop" => false,
                "progressBar" => false,
                "positionClass" => Notification::POSITION_TOP_CENTER,
                "preventDuplicates" => true,
                "onclick" => null,
                "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => false,
                "extendedTimeOut" => false,
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]
        ]);
        ?>
        </div>
    <?php endif;?>
    <!-- For version 1, 2, 3, 8 -->
    <!-- For version 1, 2, 3 -->
    <div class="container">
        <div class="row">
            <div class="col-main col-sm-9 col-sm-push-3 product-grid">
                <div class="pro-coloumn">
                    <div class="category-description std">
                        <section class="content">
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
                                'activeItemTemplate' => "<li class='breadcrumb-item active'>{link}</li>\n",
                                'options' =>['class' => 'breadcrumb category-breadcrumb'],
                            ]) ?>
                        </section>
                        <h1 style="margin-top: 0px; margin-left: 10%"><?=$this->title?></h1>
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
                                    
                                </div>
                            </div>
                        </div>',
                                    'pager' => [
                                        'hideOnSinglePage' => false,
                                        'disabledListItemSubTagOptions' => ['tag' => 'a'],
                                        'maxButtonCount' => 4,
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

