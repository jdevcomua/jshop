<div class="frame-menu-main horizontal-menu">
                        <!--    menu-row-category || menu-col-category-->
    <div class="menu-main menu-row-category container">
  <nav>
    <table>
      <tbody>
        <tr><td><div class="frame-item-menu"><div class="frame-title"><a href="?category=0" class="title" style="color: #fff;"><span class="helper" style="height: 43px;"></span><span><span class="text-el">all</span></span></a></div></div></td>
        <?php
        foreach($result1 as $i => $value){
            echo "<td><div class=\"frame-item-menu\"><div class=\"frame-title\"><a href=\"?category=";
            echo $result1[$i]['id'];
            echo "\" class=\"title\" style=\"color: #fff;\">";
            echo "<span class=\"helper\" style=\"height: 43px;\"></span><span><span class=\"text-el\">";
            echo $result1[$i]['title'];
            echo "</span></span></a></div></div></td>";
        }
        ?>
    </tr>
    </tbody>
 </table>
</nav>
</div></div>
<div class="content">
    <br>

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
                                <div class="d_i-b">
                                    <button data-trigger="[data-href='#comment']" data-scroll="true" class="count-response d_l">Отзывы                                        1                                    </button>
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
                                                    <form method="POST" action="/shop/cart/addProductByVariantId/17917">
                                                        <div class="frame-count frameCount">
                                                            <div class="number js-number" data-title="Количество на складе 1">
                                                                <input type="text" name="quantity" value="1" class="plusMinus plus-minus" data-title="Только цифры" data-min="1" data-max="1">
                                                            </div>
                                                        </div>
                                                        <div class="btn-cart-p btn-cart d_n">
                                                            <button type="button" data-id="17917" class="btnBuy">
                                                                <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                <span class="text-el">В корзине</span>
                                                            </button>
                                                        </div>
                                                        <div class="btn-buy-p btn-buy">
                                                            <button type="button" onclick="Shop.Cart.add($(this).closest(&quot;form&quot;).serialize(), &quot;17917&quot;)" class="btnBuy infoBut" data-id="17917" data-vname="" data-number="656" data-price="18" data-add-price="180" data-orig-price="" data-large-image="
                                                                                                                /uploads/shop/products/large/e4955cbea9f6aaab125baa2670729718.jpg                                                        " data-main-image="
                                                                                                                /uploads/shop/products/main/e4955cbea9f6aaab125baa2670729718.jpg                                                        " data-img="
                                                                                                                /uploads/shop/products/small/e4955cbea9f6aaab125baa2670729718.jpg                                                        " data-maxcount="1">
                                                                <span class="icon_cleaner icon_cleaner_buy"></span>
                                                                <span class="text-el">В корзину</span>
                                                            </button>
                                                        </div>
                                                        <input type="hidden" value="6376d8b505212cf6e8870964e6cb89ba" name="cms_token">                                            </form>
                                                </div>
                                            </div>
                                            <!-- Start. Wish List & Compare List buttons -->
                                            <div class="frame-wish-compare-list f-s_0 v-a_b">
                                                <div class="frame-btn-comp">
                                                    <div class="btn-compare">
                                                        <button class="toCompare" data-id="17216" type="button" data-title="К сравнению" data-firtitle="К сравнению" data-sectitle="В сравнении" data-rel="tooltip">
                                                            <span class="icon_compare"></span>
                                                            <span class="text-el d_l">К сравнению</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="frame-btn-wish js-variant-17917 js-variant" data-id="17917">
                                                    <div class="btnWish btn-wish" data-id="17917">
                                                        <button class="toWishlist isDrop" type="button" data-rel="tooltip" data-title="В желаемое" data-drop="#dropAuth">
                                                            <span class="icon_wish"></span>
                                                            <span class="text-el d_l">В желаемое</span>
                                                        </button>
                                                        <button class="inWishlist" type="button" data-rel="tooltip" data-title="В списке желаний" style="display: none;">
                                                            <span class="icon_wish"></span>
                                                            <span class="text-el d_l">В списке желания</span>
                                                        </button>
                                                    </div>
                                                    <script>
                                                        langs["Create list"] = 'Создать список';
                                                        langs["Wrong list name"] = 'Неверное имя списка';
                                                        langs["Already in Wish List"] = 'Уже в Списке Желаний';
                                                        langs["List does not chosen"] = 'Список не обран';
                                                        langs["Limit of Wish List finished "] = 'Лимит списков пожеланий исчерпан';
                                                    </script>                                </div>
                                            </div>
                                            <!-- End. Wish List & Compare List buttons -->
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
                                                <tr>
                                                    <td>-</td><td>-</td></tr>
                                                <tr>
                                                    <td>-</td><td>-</td></tr>
                                                <tr>
                                                    <td>-</td><td>-</td></tr>
                                                <tr>
                                                    <td>-</td><td>-</td></tr>
                                                <tr>
                                                    <td>-</td><td>-</td></tr>
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
                                    <button class="t-d_n f-s_0 s-all-d ref2 d_n_ d_i-b hidePart" data-trigger="[data-href='#second']" data-scroll="true">
                                        <span class="icon_arrow"></span>
                                        <span class="text-el">Смотреть все</span>
                                    </button>
                                    <!--                        End. Description block-->
                                </div>

                                <div class="inside-padd">
                                    <!--Start. Comments block-->
                                    <div class="frame-form-comment">
                                        <div class="forComments p_r">
                                            <div class="comments" id="comments">
                                                <div class="title-comment">Отзывы <button data-drop=".comments-main-form" data-place="inherit" data-overlay-opacity="0" data-after="Comments.toComment" class="m-l_5 isDrop"><span class="ref2 f-w_b">+</span> <span class="d_l_3">Добавить отзыв</span></button></div>
                                                <div class="drop comments-main-form  active inherit">
                                                    <div class="frame-comments layout-highlight horizontal-form">
                                                        <!-- Start of new comment fild -->
                                                        <div class="form-comment main-form-comments">
                                                            <div class="inside-padd">
                                                                <form method="post">
                                                                    <div class="mainPlace"></div>
                                                                    <div class="clearfix">
                                                                        <label style="width: 40%;float: left;">
                                                                            <span class="title">Имя</span>
                                <span class="frame-form-field">
                                    <input type="text" name="comment_author" value="">
                                </span>
                                                                        </label>
                                                                        <label style="width: 60%;float: left;">
                                                                            <span class="title t-a_r">E-mail</span>
                                <span class="frame-form-field">
                                    <input type="text" name="comment_email" id="comment_email" value="">
                                </span>
                                                                        </label>
                                                                    </div>
                                                                    <label>
                                                                        <span class="title">Отзыв</span>
                            <span class="frame-form-field">
                                <textarea name="comment_text" class="comment_text"></textarea>
                            </span>
                                                                    </label>
                                                                    <!-- End star reiting -->
                                                                    <!-- Start star reiting -->
                                                                    <div class="frame-label">
                                                                        <span class="title f_l t-a_l">Оценка</span>
                                                                        <div class="frame-form-field">
                                                                            <div class="star f_l">
                                                                                <div class="productRate star-big clicktemprate">
                                                                                    <div class="for_comment" style="width: 0%"></div>
                                                                                    <input class="ratec" name="ratec" type="hidden" value="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="btn-def f_r">
                                                                                <input type="submit" value="Оставить отзыв" onclick="Comments.post(this,{'visibleMainForm': '1'}, '.mainPlace')">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- End of new comment fild -->
                                                        </div>
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
                                                                        <div class="btn f_l">
                                                                            <button type="button" data-rel="cloneAddPaste" data-parid="3">
                                                                                <span class="text-el d_l_3">Ответить</span>
                                                                            </button>
                                                                        </div>
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
                                                    <button class="t-d_n f-s_0 s-all-d ref2 d_n_" data-trigger="[data-href='#comment']" data-scroll="true">
                                                        <span class="icon_arrow"></span>
                                                        <span class="text-el">Смотреть все ответы</span>
                                                    </button>
                                                </div>

                                                <div class="frame-drop-comment" data-rel="whoCloneAddPaste">
                                                    <div class="form-comment layout-highlight frame-comments">
                                                        <div class="inside-padd horizontal-form">
                                                            <form>
                                                                <label class="err-label">
                        <span class="frame-form-field">
                            <div class="frame-label error" name="error_text"></div>
                        </span>
                                                                </label>

                                                                <label>
                                                                    <span class="title">Ваше имя</span>
                        <span class="frame-form-field">
                            <input type="text" name="comment_author" value="">
                        </span>
                                                                </label>
                                                                <label>
                                                                    <span class="title">E-mail </span>
                        <span class="frame-form-field">
                            <input type="text" name="comment_email" value="">
                        </span>
                                                                </label>
                                                                <label>
                                                                    <span class="title">Ответ</span>
                        <span class="frame-form-field">
                            <textarea class="comment_text" name="comment_text"></textarea>
                        </span>
                                                                </label>
                                                                <div class="frame-label">
                        <span class="frame-form-field">
                            <input type="hidden" id="parent" name="comment_parent" value="">
                            <span class="btn-form">
                                <input type="submit" value="Комментировать" onclick="Comments.post(this, {'visibleMainForm': '0'})">
                            </span>
                        </span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d_n" id="useModeration">
                                                <div class="usemoderation">
                                                    <div class="msg">
                                                        <div class="success">
                                                            Ваш комментарий будет опубликован после модерации администратором            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                var _useModeration = 0;
                                            </script>                    </div>
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
                            <!--Block Accessories Start-->
                            <div id="fourth" class="accessories" style="">
                                <div class="inside-padd">
                                    <h2 class="m-b_30">С этим товаром покупают</h2>
                                    <ul class="items items-default">
                                        <div class="preloader"></div>
                                    </ul>
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