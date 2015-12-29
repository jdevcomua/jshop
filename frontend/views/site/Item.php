<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $form yii\widgets\ActiveForm */
?>

<?php echo $this->render('menu', ['allCategories' => $allCategories]); ?>

<div class="content">
    <br>
    <?php /* @var $item common\models\Item */ ?>
    <div class="frame-inside page-product">
        <div class="container">
            <div class="clearfix">
                <div class="f-s_0 title-product">
                    <!-- Start. Name product -->
                    <div class="frame-title">
                        <h1 class="title m-r_5"><?php echo $item['title']; ?></h1>
                    </div>
                </div>
                <div class="right-product">
                    <!--Start. Payments method form -->
                    <div class="frame-delivery-payment"><dl><dt class="title">Доставка и оплата</dt><dd class="frame-list-delivery">
                                <ul class="list-delivery">
                                    <li class="f-s_0"><span class="frame-ico"><span class="icon_d_p1">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el">Самовывоз</span><span class="d_b s-t">Со склада магазина</span></div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span class="icon_d_p2">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el">Курьерской службой </span><span class="d_b s-t">Новая почта и другие</span></div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span class="icon_d_p3">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el">Оплата наличными</span><span class="d_b s-t">Курьеру при получении</span></div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span class="icon_d_p4">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el">Безналичный платеж</span><span class="d_b s-t">Master Card, Visa; Приват 24</span></div>
                                    </li>
                                </ul>
                            </dd></dl></div>
                    <div class="frame-delivery-payment"><dl><dt class="title">Нужна помощь?</dt><dd class="frame-list-delivery"><span class="s-t">Наши менеджеры ответят на ваши вопросы и помогут с выбором:</span>
                                <ul class="list-style-1 list-phone-number">
                                    <li class="f-s_15">(093) <span class="d_n">−</span>169-36-98</li>
                                    <li class="f-s_15">(093) <span class="d_n">−</span>169-36-98</li>
                                </ul>
                            </dd></dl></div>                    <!--End. Payments method form -->
                    <!-- Start. Similar Products-->
                    <div class="default-frame">
                        <section class="">
                            <div class="default-title">
                                <div class="frame-title">
                                    <div class="title">Похожие товары</div>
                                </div>
                            </div>

                        </section>
                    </div>
                    <!-- End. Similar Products-->
                </div>
                <div class="left-product leftProduct">
                    <div class="clearfix item-product globalFrameProduct to-cart">
                        <div class="left-product-left">
                            <!-- Start. additional images-->
                            <div class="vertical-carousel">
                                <div class="frame-thumbs carousel-js-css">
                                    <div class="content-carousel" style="height: auto;">
                                        <ul class="items-thumbs items" style="height: 180px;">
                                            <!-- Start. main image-->
                                            <li class="active">
                                                <a onclick="return false;" rel="useZoom: 'photoProduct'" href="img/<?php echo $item['image']; ?>" title="" class="cloud-zoom-gallery" id="mainThumb">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                        <img src="img/<?php echo $item['image']; ?>" alt="" title="" class="vImgPr">
                                                    </span>
                                                </a>
                                            </li>
                                            <!-- End. main image-->
                                            <li>
                                                <a onclick="return false;" rel="useZoom: 'photoProduct'" href="img/<?php echo $item['image']; ?>" title="" class="cloud-zoom-gallery">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                        <img src="img/<?php echo $item['image']; ?>" alt="" title="">
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a onclick="return false;" rel="useZoom: 'photoProduct'" href="img/<?php echo $item['image']; ?>" title="" class="cloud-zoom-gallery">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                        <img src="img/<?php echo $item['image']; ?>" alt="" title="">
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="group-button-carousel">
                                        <button type="button" class="prev arrow" style="display: none;">
                                            <span class="icon_arrow_p"></span>
                                        </button>
                                        <button type="button" class="next arrow" style="display: none;">
                                            <span class="icon_arrow_n"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- End. additional images-->
                            <!-- Start. Photo block-->
                            <div id="wrap" style="top:0px;z-index:9999;position:relative;"><a rel="position: 'xBlock'" onclick="return false;" href="img/<?php echo $item['image']; ?>" class="frame-photo-title photoProduct cloud-zoom isDrop" id="photoProduct" title="" data-drop="#photo" data-start="Product.initDrop" data-scroll-content="false" style="position: relative; display: block;">
                                <span class="photo-block">
                                    <span class="helper"></span>
                                    <img src="img/<?php echo $item['image']; ?>" alt="" title="" class="vImgPr" style="display: block;" </span>
                                </a>

                            </div>
                            <!-- End. Photo block-->
                        </div>
                        <div class="left-product-right">
                            <!-- Start. Star rating -->
                            <div class="frame-star">
                                <div class="star">
                                    <div id="star_rating_17216" class="productRate star-small">
                                        <div style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- End. Star rating-->
                            <!-- Start. frame for cloudzoom -->
                            <div id="xBlock"></div>
                            <!-- End. frame for cloudzoom -->
                            <div class="f-s_0 buy-block">
                                <!-- Start. Check variant-->
                                <!-- End. Check variant-->
                                <div class="frame-prices-buy-wish-compare">
                                    <div class="frame-prices-buy f-s_0">
                                        <!-- Start. Prices-->
                                        <div class="frame-prices f-s_0">
<span class="current-prices f-s_0"><span class="price-new">
<span><span class="price priceVariant"><?php echo $item['cost']; ?></span> $</span></span>
</span></span>
                                            <!-- End. Product price-->
                                        </div>
                                        <!-- End. Prices-->
                                        <div class="funcs-buttons">
                                            <!-- Start. Collect information about Variants, for future processing -->
                                            <div class="d_i-b v-a_b">
                                                <div class="frame-count-buy js-variant-17917 js-variant">

                                                    <?php
                                                    echo Html::input('number', 'count', '1', ['id' => 'test', 'style' => 'height: 31px;']);
                                                    ?>
                                                    <div class="btn-buy-p btn-buy">
                                                        <?php echo Html::button('<span class="text-el">' . \Yii::t('app', 'В корзину') . '</span>', ['onClick' => '$.ajax({
                url: \'site/ajax\',
                data: { item_id: ' . $item->id . ', count: $(\'#test\').val()},
                dataType: \'text\',
                success: function(data){
                var count = $(\'#countItems \').html();
                    $(\'#countItems \').html(+count + +$(\'#test\').val());
                }
            });']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End. Collect information about Variants, for future processing -->
                                    </div>
                                </div>
                            </div>
                            <!-- Start. Description -->
                            <div class="short-desc">
                                <p>краткое описание</p>
                            </div>
                        </div>
                    </div>

                    <!-- Start. Tabs block-->
                    <div class="f-s_0">
                        <ul class="tabs tabs-data tabs-product">
                            <li class="active">
                                <button data-href="#view">Обзор</button>
                            </li>

                            <li><button data-href="#first" data-source="http://active.imagecmsdemo.net/shop/product_api/renderProperties" data-data="{&quot;product_id&quot;: 17216}" data-selector=".characteristic">Свойства</button></li>
                            <li><button data-href="#second" data-source="http://active.imagecmsdemo.net/shop/product_api/renderFullDescription" data-data="{&quot;product_id&quot;: 17216}" data-selector=".inside-padd > .text">Полное описание</button></li>
                            <!--Output of the block comments-->
                            <li>
                                <button type="button" data-href="#comment" onclick="Comments.renderPosts($('#comment .inside-padd'),{'visibleMainForm': '1'})">
                                    <span class="icon_comment-tab"></span>
                <span class="text-el">
                    <span id="cc">
                                                1                        отзыв                                            </span>
                </span>
                                </button>
                            </li>
                        </ul>
                        <div class="frame-tabs-ref frame-tabs-product">
                            <div id="view">
                                <div class="inside-padd">
                                    <div class="title-h2">Свойства</div>
                                    <div class="characteristic">
                                        <div class="product-charac patch-product-view showHidePart">
                                            <table border="0" cellpadding="4" cellspacing="0" class="characteristic">
                                                <tbody>
                                                <?php foreach ($item->getCharacteristicItems()->all() as $i => $value) {
                                                    /* @var $value common\models\CharacteristicItem*/
                                                    echo "<tr><td>".$value->getCharacteristic()->one()['title']."</td>";
                                                    echo "<td>".$value->value."</td></tr>";
                                                }
                                                //var_dump($item->getCategory()->one()['title']);
                                                ?>
                                                </tbody>
                                            </table>                    </div>
                                        <button class="t-d_n f-s_0 s-all-d ref2 d_n_" data-trigger="[data-href='#first']" data-scroll="true">
                                            <span class="icon_arrow"></span>
                                            <span class="text-el">Смотреть все</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="inside-padd">
                                    <!--                        Start. Description block-->
                                    <div class="product-descr patch-product-view showHidePart" style="max-height: none; height: 250px;">
                                        <div class="text">
                                            <div class="title-h2">Описание</div>
                                            <h2>...</h2>
                                            <p></p>                      </div>
                                    </div>
                                    <!--                        End. Description block-->
                                </div>

                                <div class="inside-padd">
                                    <!--Start. Comments block-->
                                    <div class="frame-form-comment">
                                        <div class="forComments p_r">
                                            <div class="comments" id="comments">
                                                <div class="title-comment">Отзывы </div>
                                                <div class="drop comments-main-form  active inherit">
                                                    <div class="frame-comments layout-highlight horizontal-form">

                                                    </div>
                                                </div>
                                                <div class="frame-list-comments">
                                                    <ul class="sub-1 product-comment patch-product-view showHidePart">
                                                        <li>
                                                            <input type="hidden" name="comment_item_id" value="3">
                                                            <div class="clearfix global-frame-comment-sub1">
                                                                <div class="author-data-comment author-data-comment-sub1">
                                                                    <span class="f-s_0 frame-autor-comment"><span class="icon_comment"></span><span class="author-comment">admin</span></span>
                        <span class="date-comment">
                            <span class="day">02 </span>
                            <span class="month">Сентября </span>
                            <span class="year">2014 </span>
                        </span>
                                                                    <div class="mark-pr">
                                                                        <span class="title">Оценка товара:</span>
                                                                        <div class="star-small d_i-b">
                                                                            <div class="productRate star-small">
                                                                                <div style="width: 100%;"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="frame-comment-sub1">
                                                                    <div class="frame-comment">
                                                                        <p>...</p>
                                                                    </div>
                                                                    <div class="footer-comment clearfix">

                                                                        <div class="frame-mark f_r">
                                                                            <div class="func-button-comment">
                                                                                <span class="s-t">Отзыв полезен?</span>
                                    <span class="btn like">
                                        <button type="button" class="usefullyes" data-comid="3">
                                            <span class="icon_like"></span>
                                            <span class="text-el d_l_3">Да<span class="yesholder3 d_n">(0)</span></span>
                                        </button>
                                    </span>
                                    <span class="btn dis-like">
                                        <button type="button" class="usefullno" data-comid="3">
                                            <span class="icon_dislike"></span>
                                            <span class="text-el d_l_4">Нет<span class="noholder3 d_n">(0)</span></span>
                                        </button>
                                    </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div data-place="3"></div>
                                                            <div class="btn-all-comments">
                                                                <button type="button"><span class="text-el" data-hide="<span class=&quot;d_l_1&quot;>Скрыть</span> ↑" data-show="<span class=&quot;d_l_1&quot;>Смотреть все ответы</span> ↓"></span></button>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="frame-drop-comment" data-rel="whoCloneAddPaste">
                                                    <div class="form-comment layout-highlight frame-comments">
                                                        <div class="inside-padd horizontal-form">
                                                            <?php echo $this->render('vote', [
                                                                'vote' => new \common\models\Vote(), 'model'=> $item
                                                            ]) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End. Comments block-->
                                    </div>
                                </div>
                            </div>
                            <!--             Start. Characteristic-->
                            <div id="first" style="">
                                <div class="inside-padd">
                                    <div class="title-h2">Свойства</div>
                                    <div class="characteristic">
                                        <div class="preloader"></div>
                                    </div>
                                </div>
                            </div>
                            <!--                    End. Characteristic-->
                            <div id="second" style="">
                                <div class="inside-padd">
                                    <div class="title-h2">Описание</div>
                                    <div class="text">
                                        <div class="preloader"></div>
                                    </div>
                                </div>
                            </div>
                            <div id="comment" style="">
                                <div class="inside-padd forComments p_r">
                                    <div class="preloader"></div>
                                </div>
                            </div>

                        </div>
                        <!-- End. Tabs block-->
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="http://active.imagecmsdemo.net/templates/active/js/cusel-min-2.5.js"></script>                </div>
<div class="h-footer"></div>