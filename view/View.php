<div class="frame-menu-main horizontal-menu">
                        <!--    menu-row-category || menu-col-category-->
    <div class="menu-main menu-row-category container">
  <nav>
    <table>
      <tbody>
        <tr><td><a href="?id=0" style="color: #fff;"><span class="helper" style="height: 43px;"></span><span><span class="text-el">all</span></span></a></div></div></td>
        <?php
        foreach($result1 as $i => $value){
            echo "<td><div class=\"frame-item-menu\"><div class=\"frame-title\"><a href=\"?id=";
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
</div></div></div>
<div class="content">
    <br>
<div class="frame-inside page-category">
    <div class="container">
        <div class="right-catalog">
            <!-- Start. Category name and count products in category-->
            <div class="f-s_0 title-category">
                <div class="frame-title">
                    <h1 class="title"><?php echo $category;?></h1>
                </div>
                <span class="count">Найдено <?php echo $count; ?> товаров</span>
            </div>
            <!-- End. Category name and count products in category-->
                        <!--Start. Banners block-->
            
            <!--End. Banners-->
                <div class="frame-header-category">
        <div class="header-category f-s_0">
            <div class="inside-padd clearfix">
                <!-- Start. Order by block -->
                <div class="frame-sort f_l">
                    <span class="title s-t f_l">Сортировать:</span>
                    <ul class="nav-sort nav f_l" id="sort" name="order">
                        <li><button type="button" data-value="action" class="d_l_3">Акции</button></li>
                        <li><button type="button" data-value="price" class="d_l_3">От дешевых к дорогим</button></li>
                        <li><button type="button" data-value="price_desc" class="d_l_3">От дорогих к дешевым</button></li>
                        <li><button type="button" data-value="hit" class="d_l_3">Популярные</button></li>
                        <li><button type="button" data-value="rating" class="d_l_3">Рейтинг</button></li>
                        <li><button type="button" data-value="hot" class="d_l_3">Новинки</button></li>
                    </ul>
                </div>
                <!-- End. Order by block -->
            </div>
            <!--                Start. if $CI->uri->segment(2) == "search" then show hidden field-->
                        <!--                End. if $CI->uri->segment(2) == "search" then show hidden field-->
        </div>
    </div>
            <!-- Start.If count products in category > 0 then show products list and pagination links -->
                            <ul class="animateListItems items items-catalog  table" id="items-catalog-main">
                    <!-- Include template for one product item-->

                            <?php
                                foreach($result2 as $i => $value){
                                    echo "<li class=\"globalFrameProduct to-cart\" data-pos=\"top\"><a href=\"\" class=\"frame-photo-title\"><span class=\"photo-block\"><span class=\"helper\"></span><img src=\"http://zanogu.com/img/gentpls/tpl-m-34.jpg\" alt=\"\"></span><span class=\"title\">";
                                    echo $value['title'];
                                    echo "</span></a><div class=\"description\"><div class=\"left-description\"><div class=\"frame-star f-s_0\"><div class=\"star\"><div id=\"star_rating_17337\" class=\"productRate star-small\"><div style=\"width: 0%\"></div></div></div><a href=\"\" class=\"count-response\">Отзывы 1</a> </div></div><div class=\"frame-prices-buttons\"><div class=\"frame-prices f-s_0\"><span class=\"current-prices f-s_0\"><span class=\"price-new\"><span><span class=\"price priceVariant\">";
                                    echo $value['cost'];
                                    echo "</span> $</span></span></span></div>";
                                    echo " <div class=\"decor-element\" style=\"height: 281px; width: 100%; position: absolute; right: auto; left: 0px; bottom: auto; top: 0px;\"></div>
    </li>";
                                }
                            ?>



<!--
        <div class="f-s_0 m-b_10"><div class="funcs-buttons"><div class="btn-buy"><button type="button" class="btnBuy infoBut" data-rel="tooltip" data-title="Добавить в корзину">
<span class="icon_cleaner icon_cleaner_buy"></span><span class="text-el">Купить</span></button></div></div></div>
<div class="frame-wish-compare-list f-s_0"><div class="frame-btn-comp">
<div class="btn-compare"><button class="toCompare" type="button" data-title="В список сравнений" data-rel="tooltip">
<span class="icon_compare"></span><span class="text-el d_l">В список сравнений</span></button></div></div>
<div class="frame-btn-wish js-variant-18047 js-variant d_i-b_">
    <div class="btnWish btn-wish" data-id="18047">
    <button class="toWishlist isDrop" type="button" data-rel="tooltip" data-title="В желаемое" data-drop="#dropAuth">
        <span class="icon_wish"></span>
        <span class="text-el d_l">В желаемое</span>
    </button>
    <button class="inWishlist" type="button" data-rel="tooltip" data-title="В списке желаний" style="display: none;">
        <span class="icon_wish"></span>
        <span class="text-el d_l">В списке желания</span>
    </button>
</div>
</div></div></div>
                            </div>
        </div>

        <div class="decor-element" style="height: 281px; width: 100%; position: absolute; right: auto; left: 0px; bottom: auto; top: 0px;"></div>
    </li>-->




                </ul>
                <!-- render pagination-->
                                        <!-- End.If count products in category > 0 then show products and pagination links -->
            </ul>
            <!-- render pagination-->

            </ul>
            <!-- render pagination-->

        </div>
        <div class="filter left-catalog">
            <!-- Load filter-->
            <!-- end of selected filters block -->

            <form method="get" id="catalogForm">
                <input type="hidden" name="order" value="action" />
                <input type="hidden" name="user_per_page" value="12"/>
                <div class="frame-filter p_r">
                    <script type="text/javascript">
                        totalProducts = parseInt('16');
                        function createObjSlider(minCost, maxCost, defMin, defMax, curMin, curMax, lS, rS){
                            this.minCost = minCost;
                            this.maxCost = maxCost;
                            this.defMin = defMin;
                            this.defMax = defMax;
                            this.curMin = curMin;
                            this.curMax = curMax;
                            this.lS = lS;
                            this.rS = rS;
                        };
                        sliders = new Object();
                        sliders.slider1 = new createObjSlider('.minCost', '.maxCost', 185, 780, 185, 780, 'lp', 'rp');
                    </script><div class="preloader wo-i"></div>
                    <div id="slider-range"></div>
                    <div class="frames-checks-sliders">
                        <div class="frame-slider" data-rel="sliders.slider1">
                            <div class="inside-padd">
                                <div class="title">Фильтр по цене</div>
                                <div class="slider-cont">
                                    <noscript>Джаваскрипт не включен</noscript>
                                    <div class="slider" id="slider1">
                                        <a href="#" class="ui-slider-handle left-slider"></a>
                                        <a href="#" class="ui-slider-handle right-slider"></a>
                                    </div>
                                </div>
                                <div class="form-cost number">
                                    <div class="t-a_j">
                                        <label>
                                            <input type="text" class="minCost" data-title="только цифры" name="lp" value="185" data-mins="185"/>
                                        </label>
                                        <label>
                                            <input type="text" class="maxCost" data-title="только цифры" name="rp" value="780" data-maxs="780"/>
                                        </label>
                                        <div class="btn-def d_n">
                                            <input type="submit" value="ОК"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-foot">
                            <div class="inside-padd t-a_c">
                                <div class="btn-form">
                                    <button type="submit">
                                        <span class="text-el">Фильтровать</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input disabled="disabled" type="hidden" name="requestUri" value="http://active.imagecmsdemo.net/shop/category/sport/velosport/velosipedy"/>    </div>
            </form>
            <script>
            </script>

        </div>
        <!--widget for popular products in this category-->
    </div>
</div>
    <!--Start. Popular products -->
    <!--End. Popular products -->
    <script type="text/javascript" src="http://active.imagecmsdemo.net/templates/active/js/cusel-min-2.5.js"></script>                </div>
<div class="h-footer"></div>
</div>































