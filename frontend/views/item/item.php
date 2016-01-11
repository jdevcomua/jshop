<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $form yii\widgets\ActiveForm */
?>

<?php echo $this->render('../layouts/menu', ['allCategories' => $allCategories]); ?>

<div class="content">
    <br>
    <?php /* @var $item common\models\Item */ ?>
    <div class="frame-inside page-product">
        <div class="container">
            <div class="clearfix">
                <div class="f-s_0 title-product">
                    <!-- Start. Name product -->
                    <?php if (isset($message)) { ?>
                    <div style="width: 505px; background: #fbfff9; border:1px solid #96C61E; padding: 10px;border-radius: 2%;margin-bottom: 15px;">
                        <span style="opacity: 1;"><?php echo $message; ?></span>
                    </div>
                    <?php } ?>
                    <div class="frame-title">
                        <h1 class="title m-r_5"><?php echo $item['title']; ?></h1>
                    </div>
                </div>
                <div class="right-product">
                    <!--Start. Payments method form -->
                    <div class="frame-delivery-payment">
                        <dl>
                            <dt class="title"><?php echo \Yii::t('app', 'Доставка и оплата'); ?></dt>
                            <dd class="frame-list-delivery">
                                <ul class="list-delivery">
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p1">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el"><?php echo \Yii::t('app', 'Самовывоз'); ?></span><span class="d_b s-t"><?php echo \Yii::t('app', 'Со склада магазина'); ?></span>
                                        </div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p2">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el"><?php echo \Yii::t('app', 'Курьерской службой'); ?> </span><span
                                                class="d_b s-t"><?php echo \Yii::t('app', 'Новая почта и другие'); ?></span></div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p3">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el"><?php echo \Yii::t('app', 'Оплата наличными'); ?></span><span
                                                class="d_b s-t"><?php echo \Yii::t('app', 'Курьеру при получении'); ?></span></div>
                                    </li>
                                    <li class="f-s_0"><span class="frame-ico"><span
                                                class="icon_d_p4">&nbsp;</span></span>
                                        <div class="descr"><span class="text-el"><?php echo \Yii::t('app', 'Безналичный платеж'); ?></span><span
                                                class="d_b s-t"><?php echo \Yii::t('app', 'Master Card, Visa; Приват 24'); ?></span></div>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                    <div class="frame-delivery-payment">
                        <dl>
                            <dt class="title"><?php echo \Yii::t('app', 'Нужна помощь?'); ?></dt>
                            <dd class="frame-list-delivery"><span class="s-t"><?php echo \Yii::t('app', 'Наши менеджеры ответят на ваши вопросы и помогут с выбором:'); ?></span>
                                <ul class="list-style-1 list-phone-number">
                                    <li class="f-s_15">(093) <span class="d_n">−</span>169-36-98</li>
                                    <li class="f-s_15">(093) <span class="d_n">−</span>169-36-98</li>
                                </ul>
                            </dd>
                        </dl>
                    </div>                    <!--End. Payments method form -->
                    <!-- Start. Similar Products-->
                    <div class="default-frame">
                        <section class="">
                            <div class="default-title">
                                <div class="frame-title">
                                    <div class="title"><?php echo \Yii::t('app', 'Похожие товары'); ?></div>
                                </div><?php echo \Yii::t('app', ''); ?>
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
                                                <a onclick="return false;" rel="useZoom: 'photoProduct'"
                                                   href="<?php echo $item->getImageUrl(); ?>" title=""
                                                   class="cloud-zoom-gallery" id="mainThumb">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                        <img src="<?php echo $item->getImageUrl(); ?>" alt="" title=""
                                                             class="vImgPr">
                                                    </span>
                                                </a>
                                            </li>
                                            <!-- End. main image-->
                                            <li>
                                                <a onclick="return false;" rel="useZoom: 'photoProduct'"
                                                   href="<?php echo $item->getImageUrl(); ?>" title=""
                                                   class="cloud-zoom-gallery">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                        <img src="<?php echo $item->getImageUrl(); ?>" alt="" title="">
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a onclick="return false;" rel="useZoom: 'photoProduct'"
                                                   href="<?php echo $item->getImageUrl(); ?>" title=""
                                                   class="cloud-zoom-gallery">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                        <img src="<?php echo $item->getImageUrl(); ?>" alt="" title="">
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
                            <div id="wrap" style="top:0px;z-index:9999;position:relative;"><a rel="position: 'xBlock'"
                                                                                              onclick="return false;"
                                                                                              href="<?php echo $item->getImageUrl(); ?>"
                                                                                              class="frame-photo-title photoProduct cloud-zoom isDrop"
                                                                                              id="photoProduct" title=""
                                                                                              data-drop="#photo"
                                                                                              data-start="Product.initDrop"
                                                                                              data-scroll-content="false"
                                                                                              style="position: relative; display: block;">
                                <span class="photo-block">
                                    <span class="helper"></span>
                                    <img src="<?php echo $item->getImageUrl(); ?>" alt="" title="" class="vImgPr"
                                         style="display: block;" </span>
                                </a>

                            </div>
                            <!-- End. Photo block-->
                        </div>
                        <div class="left-product-right">
                            <!-- Start. Star rating -->
                            <?php if ($item->getAvgRating()['avg'] != 0) { ?>
                                <div class="mark-pr">
                                    <span class="title"><?php //echo \Yii::t('app', 'Оценка товара:'); ?></span>
                                    <div class="rateit" data-rateit-value="<?php echo $item->getAvgRating()['avg']; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                    (<?php echo $item->getAvgRating()['count']; ?>)
                                </div>
                            <?php } ?>
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
                                            <span><span class="price priceVariant"><?php echo $item['cost']; ?></span> </span></span>
                                            </span></span>
                                            <!-- End. Product price-->
                                        </div>
                                        <!-- End. Prices-->
                                        <div class="funcs-buttons">
                                            <!-- Start. Collect information about Variants, for future processing -->
                                            <div class="d_i-b v-a_b">
                                                <div class="frame-count-buy js-variant-17917 js-variant">
                                                    <div style="display:block; float:left;margin-right:10px;">
                                                        <?php
                                                        echo Html::input('number', 'count', '1', ['id' => 'test', 'style' => 'height: 30px;padding: 0 0 0 5px;width:75px;']);
                                                        ?>
                                                    </div>
                                                    <div class="btn-buy-p btn-buy" style="display:block; float:left;">
                                                        <?php echo Html::button('<span class="text-el">' . \Yii::t('app', 'В корзину') . '</span>', ['onClick' => 'addToCartFromItemPage(' . $item->id . ')']); ?>
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
                                <button data-href="#view"><?php echo \Yii::t('app', 'Обзор'); ?></button>
                            </li>

                            <li>
                                <button data-href="#first"
                                        data-source="http://active.imagecmsdemo.net/shop/product_api/renderProperties"
                                        data-data="{&quot;product_id&quot;: 17216}" data-selector=".characteristic">
                                    <?php echo \Yii::t('app', 'Свойства'); ?>
                                </button>
                            </li>
                            <li>
                                <button data-href="#second"
                                        data-source="http://active.imagecmsdemo.net/shop/product_api/renderFullDescription"
                                        data-data="{&quot;product_id&quot;: 17216}"
                                        data-selector=".inside-padd > .text"><?php echo \Yii::t('app', 'Полное описание'); ?>
                                </button>
                            </li>
                            <!--Output of the block comments-->
                            <li>
                                <button type="button" data-href="#comment" >
                                    <span class="icon_comment-tab"></span>
                                    <span class="text-el">
                                        <span id="cc">
                                            <?php echo \Yii::t('app', 'Отзывы'); ?>
                                        </span>
                                    </span>
                                </button>
                            </li>
                        </ul>
                        <div class="frame-tabs-ref frame-tabs-product">
                            <div id="view">
                                <div class="inside-padd">
                                    <div class="title-h2"><?php echo \Yii::t('app', 'Свойства'); ?></div>
                                    <div class="characteristic">
                                        <div class="product-charac patch-product-view showHidePart">
                                            <table border="0" cellpadding="4" cellspacing="0" class="characteristic">
                                                <tbody>
                                                <?php foreach ($item->getCharacteristicItems()->all() as $i => $value) {
                                                    /* @var $value common\models\CharacteristicItem */
                                                    echo "<tr><td>" . $value->getCharacteristic()->one()['title'] . "</td>";
                                                    echo "<td>" . $value->value . "</td></tr>";
                                                }
                                                //var_dump($item->getCategory()->one()['title']);
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button class="t-d_n f-s_0 s-all-d ref2 d_n_"
                                                data-trigger="[data-href='#first']" data-scroll="true">
                                            <span class="icon_arrow"></span>
                                            <span class="text-el"><?php echo \Yii::t('app', 'Смотреть все'); ?></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="inside-padd">
                                    <!--                        Start. Description block-->
                                    <div class="product-descr patch-product-view showHidePart">
                                        <div class="text">
                                            <div class="title-h2"><?php echo \Yii::t('app', 'Описание'); ?></div>
                                            <h2>...</h2>
                                            <p></p></div>
                                    </div>
                                    <!--                        End. Description block-->
                                </div>

                                <div class="inside-padd">
                                    <!--Start. Comments block-->
                                    <div class="frame-form-comment">
                                        <div class="forComments p_r">
                                            <div class="comments" id="comments">
                                                <div class="title-comment"><?php echo \Yii::t('app', 'Отзывы'); ?></div>
                                                <div class="drop comments-main-form  active inherit">
                                                    <div class="frame-comments layout-highlight horizontal-form">

                                                    </div>
                                                </div>
                                                <div class="frame-list-comments">
                                                    <ul class="sub-1 product-comment patch-product-view showHidePart">
                                                        <?php foreach ($item->votes as $vote) {
                                                            /* @var $vote \common\models\Vote */
                                                            if ($vote->checked == 1) {
                                                            ?>
                                                        <li><hr>
                                                            <div style="padding: 10px 0 5px 0;" class="clearfix global-frame-comment-sub1">
                                                                <div class="author-data-comment author-data-comment-sub1">
                                                                    <span class="f-s_0 frame-autor-comment"><span class="icon_comment"></span>
                                                                        <span class="author-comment"><b><?php echo isset($vote->user) ? $vote->user->username : 'Гость'; ?></b></span></span>
                                                                    <span class="date-comment">
                                                                        <span class="day"><?php echo $vote->timestamp; ?></span>
                                                                    </span>
                                                                    <?php if (!empty($vote->rating)) { ?>
                                                                    <div class="mark-pr">
                                                                        <span class="title"><?php echo \Yii::t('app', 'Оценка товара:'); ?></span>
                                                                        <div class="rateit" data-rateit-value="<?php echo $vote->rating; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>

                                                                    </div>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="frame-comment-sub1">
                                                                    <div class="frame-comment">
                                                                        <p><?php echo $vote->text; ?></p>
                                                                    </div>
                                                                    <div class="footer-comment clearfix">

                                                                        <!--<div class="frame-mark f_r">
                                                                            <div class="func-button-comment">
                                                                                <span class="s-t"><?php echo \Yii::t('app', 'Отзыв полезен?'); ?></span>
                                    <span class="btn like">
                                        <button type="button" class="usefullyes" data-comid="3">
                                            <span class="icon_like"></span>
                                            <span class="text-el d_l_3"><?php //echo \Yii::t('app', 'Да'); ?><span class="yesholder3 d_n">(0)</span></span>
                                        </button>
                                    </span>
                                    <span class="btn dis-like">
                                        <button type="button" class="usefullno" data-comid="3">
                                            <span class="icon_dislike"></span>
                                            <span class="text-el d_l_4"><?php //echo \Yii::t('app', 'Нет'); ?><span class="noholder3 d_n">(0)</span></span>
                                        </button>
                                    </span>
                                                                            </div>
                                                                        </div>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php } } ?>
                                                    </ul>
                                                </div>
                                                <br>
                                                <div class="frame-drop-comment" data-rel="whoCloneAddPaste">
                                                    <div class="form-comment layout-highlight frame-comments">
                                                        <h4>Оставить отзыв</h4>
                                                        <div class="inside-padd horizontal-form">
                                                            <?php echo $this->render('vote', [
                                                                'vote' => new \common\models\Vote(), 'model' => $item
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
                                    <div class="title-h2"><?php echo \Yii::t('app', 'Свойства'); ?></div>
                                    <div class="characteristic">
                                        <div class="preloader"></div>
                                    </div>
                                </div>
                            </div>
                            <!--                    End. Characteristic-->
                            <div id="second" style="">
                                <div class="inside-padd">
                                    <div class="title-h2"><?php echo \Yii::t('app', 'Описание'); ?></div>
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
    <script type="text/javascript" src="http://active.imagecmsdemo.net/templates/active/js/cusel-min-2.5.js"></script>
</div>
<div class="h-footer"></div>