<?php

use yii\widgets\ListView;
use common\models\Item;

/* @var $category \common\models\ItemCat */
?>

<div class="content">
    <br>
    <div class="frame-inside page-category">
        <div class="container">
            <div class="left-start-page">
                <div class="frame-baner frame-baner-start_page" style="height: 270px;">
                    <style>
                        #owl-demo .item img{
                            display: block;
                            width: 100%;
                            height: auto;
                        }
                    </style>
                    <div id="demo">
                        <div class="container">
                            <div class="row">
                                <div class="span12">
                                    <div id="owl-demo" class="owl-carousel">
                                        <?php foreach (\common\models\Stock::find()->current()->all() as $stock) {
                                            /* @var $stock \common\models\Stock*/
                                            ?>
                                            <div class="item" align="center">
                                                <a href="<?php echo Yii::$app->urlHelper->to(['promotion/' . $stock->id]); ?>">
                                                    <img style="max-height: 227px;width:initial;"
                                                        src="<?php echo $stock->getImageUrl(); ?>">
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $("#owl-demo").owlCarousel({

                                navigation : false,
                                slideSpeed : 500,
                                paginationSpeed : 500,
                                singleItem : true,
                                autoPlay: 5000,
                                stopOnHover: true

                            });
                        });
                    </script>
                </div>
                <div id="new_products" style="margin-top: 4px;">
                    <div class="horizontal-carousel">
                        <section class="special-proposition">
                            <div class="title-proposition-h">
                                <div class="frame-title">
                                    <div class="title">мы рекомендуем</div>
                                </div>
                            </div>
                            <div class="big-container">
                                <div class="items-carousel">
                                    <div class="content-carousel container">
                                            <?php
                                            $dataProvider = new \yii\data\ActiveDataProvider([
                                                'query' => $items
                                            ]);
                                            echo ListView::widget([
                                                'dataProvider' => $dataProvider,
                                                'itemView' => function ($model, $key, $index, $widget) {
                                                    return $this->render('item', ['value' => $model]);
                                                },
                                                'options' => [
                                                    'tag' => 'ul',
                                                    'class' => 'items items-catalog items-h-carousel',
                                                ],
                                                'itemOptions' => [
                                                    'tag' => 'li',
                                                    'class' => 'globalFrameProduct to-cart',
                                                    'style' => 'width: 200px;'
                                                ],
                                            ]);
                                            ?>
                                    </div>
                                    <div class="group-button-carousel">
                                        <button type="button" class="prev arrow">
                                            <span class="icon_arrow_p"></span>
                                        </button>
                                        <button type="button" class="next arrow">
                                            <span class="icon_arrow_n"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                </div>

            </div>
            <div class="right-start-page">
                <div class="frame-little-banner">
                    <p>
                        <a href="http://active.imagecmsdemo.net/dostavka"><img
                                src="http://active.imagecmsdemo.net/uploads/shop/banners/banner_small.jpg" alt=""></a>
                    </p>
                </div>
                <div id="action_products">
                    <div class="vertical-carousel">
                        <section class="special-proposition">
                            <div class="title-proposition-v">
                                <div class="frame-title">
                                    <div class="title">Цена недели</div>
                                </div>
                            </div>
                            <div class="big-container">
                                <div class="frame-baner frame-baner-start_page" style="padding-bottom: 5px;">
                                    <style>
                                        #owl-demo1 .item img{
                                            width: initial;
                                            height: 200px;
                                        }
                                        .frame-photo-title{
                                            text-decoration: none;
                                        }
                                        .photo-block {
                                            width: 200px;
                                            height: 160px;
                                            padding: 7px;
                                        }
                                    </style>
                                    <div id="demo">
                                        <div class="container">
                                            <div class="row">
                                                <div class="span12">
                                                    <?php
                                                    $dataProvider = new \yii\data\ActiveDataProvider([
                                                        'query' => Item::find()->threeItems()
                                                    ]);
                                                    echo ListView::widget([
                                                        'dataProvider' => $dataProvider,
                                                        'itemView' => function ($model, $key, $index, $widget) {
                                                            return $this->render('item', ['value' => $model]);
                                                        },
                                                        'options' => [
                                                            'tag' => 'div',
                                                            'class' => 'owl-carousel',
                                                            'id' => 'owl-demo1',
                                                            'align' => 'center',
                                                        ],
                                                        'itemOptions' => [
                                                            'tag' => 'div',
                                                            'class' => 'item',
                                                        ],
                                                        'summary'=>'',
                                                    ]);
                                                    ?>
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    $("#owl-demo1").owlCarousel({

                                                        navigation : false,
                                                        slideSpeed : 500,
                                                        paginationSpeed : 500,
                                                        singleItem : true,
                                                        autoPlay: 5000,
                                                        stopOnHover: true,
                                                        baseClass: 'owl-carousel1',
                                                        autoHeight: true

                                                    });
                                                });
                                            </script>
                                        </div>

                                    </div>

                                </div>
                                </div>
                        </section>
                    </div>
                </div>
                <div id="action_products">
                    <div class="vertical-carousel">
                        <section class="special-proposition">
                            <div class="title-proposition-v">
                                <div class="frame-title">
                                    <div class="title">Топ продаж</div>
                                </div>
                            </div>
                            <div class="big-container">
                                <div class="frame-baner frame-baner-start_page" style="padding-bottom: 5px;">
                                    <style>
                                        #owl-demo2 .item img{
                                            width: initial;
                                            height: 200px;
                                        }
                                        .frame-photo-title{
                                            text-decoration: none;
                                        }
                                        .photo-block {
                                            width: 200px;
                                            height: 160px;
                                            padding: 7px;
                                        }
                                    </style>
                                    <div id="demo">
                                        <div class="container">
                                            <div class="row">
                                                <div class="span12">
                                                        <?php
                                                        $dataProvider = new \yii\data\ActiveDataProvider([
                                                            'query' => Item::find()->top()
                                                        ]);
                                                        echo ListView::widget([
                                                            'dataProvider' => $dataProvider,
                                                            'itemView' => function ($model, $key, $index, $widget) {
                                                                return $this->render('item', ['value' => $model]);
                                                            },
                                                            'options' => [
                                                                'tag' => 'div',
                                                                'class' => 'owl-carousel',
                                                                'id' => 'owl-demo2',
                                                                'align' => 'center',
                                                            ],
                                                            'itemOptions' => [
                                                                'tag' => 'div',
                                                                'class' => 'item',
                                                            ],
                                                            'summary'=>'',
                                                        ]);
                                                        ?>

                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    $("#owl-demo2").owlCarousel({

                                                        navigation : false,
                                                        slideSpeed : 500,
                                                        paginationSpeed : 500,
                                                        singleItem : true,
                                                        autoPlay: 5000,
                                                        stopOnHover: true,
                                                        baseClass: 'owl-carousel',
                                                        autoHeight: true

                                                    });
                                                });
                                            </script>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://active.imagecmsdemo.net/templates/active/js/cusel-min-2.5.js"></script>
</div>
<div class="h-footer"></div>
<div id="forCenter" class="forCenter d_n" data-rel="#wishListPopup"
     style="left: 0px; width: 100%; position: fixed; height: 100%; overflow-x: auto; z-index: 1105; display: block; top: 0px; background: rgba(0, 0, 0, 0.8);">
    <div class="drop drop-style drop-wishlist center active" id="wishListPopup"
         style="z-index: 1105; position: fixed; display: block; top: 20%; left: 491px;">
        <button type="button" class="icon_times_drop" data-closed="closed-js" onclick="closeWishWindow()"></button>
        <div class="drop-header">
            <div class="title">
                Выбор cписка желаний
            </div>
        </div>
        <div class="drop-content" style="overflow: hidden; padding: 0px; height: 197px; width: 300px;">
            <div class="jspContainer" style="width: 300px; height: 189px;">
                <div class="jspPane" style="padding: 0px; top: 0px; width: 300px;">
                    <div class="inside-padd">
                        <div class="horizontal-form">
                            <form method="post" action="" onsubmit="return false;">
                                <div class="frame-radio">
                                    <?php if (!empty($wishLists)) { ?>
                                        <div class="frame-label active">
                                            <input class="wishRadio" type="radio" name="wishlist" value="1"
                                                   checked="checked">
                                            <select id="wishSelect"
                                                    style="width:217px;border-color: #dfdfdf;padding-left:5px;box-shadow: inset 0 1px 1px #f8f7f7;">
                                                <?php foreach ($wishLists as $list) { ?>
                                                    <option
                                                        value="<?php echo $list->id; ?>"><?php echo $list->title; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <div class="frame-label">
                                        <input class="wishRadio" type="radio" name="wishlist" value="2"
                                               data-link="[name=&quot;wishListName&quot;]">
                                        Новый
                                    </div>
                                </div>
                                <div class="frame-label">
                                    <input type="text" name="wishListName" value="" class="wish_list_name">
                                </div>
                                <div class="btn-def">
                                    <button type="submit" onclick="addToWishList()" сlass="isDrop">
                                        <span class="text-el">Добавить в список</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="drop-footer"></div>
    </div>
</div>
<div id="forCenterAuth" class="forCenter d_n" data-rel="#wishListPopup"
     style="left: 0px; width: 100%; position: fixed; height: 100%; overflow-x: auto; z-index: 1105; display: block; top: 0px; background: rgba(0, 0, 0, 0.8);">
    <div class="drop drop-style center active" id="dropAuth"
         style="z-index: 1104; position: fixed; display: block; top: 40%; left: 491px;">
        <button type="button" class="icon_times_drop" data-closed="closed-js" onclick="closeWishAuthWindow()"></button>
        <div class="drop-content t-a_c"
             style="min-height: 0px; overflow: hidden; padding: 0px; height: 75px; width: 350px;">
            <div class="jspContainer" style="width: 350px; height: 75px;">
                <div class="jspPane" style="padding: 0px; top: 0px; width: 350px;">
                    <div class="inside-padd">
                        Для того, что бы добавить товар в список желаний, Вам нужно <a
                            href="<?php echo Yii::$app->urlHelper->to(['login']); ?>">
                            <button type="button" class="d_l_1 isDrop">авторизоваться</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>