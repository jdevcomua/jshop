<?php

use common\models\Stock;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use common\models\Item;

/* @var $category \common\models\ItemCat */
/* @var $stocks Stock[] */
/* @var $salesCount integer */
/* @var $salesDataProvider ActiveDataProvider */
/* @var $topDataProvider ActiveDataProvider */
/* @var $itemsDataProvider ActiveDataProvider */

$this->title = 'Интернет-магазин';
?>

<div class="left-start-page">
    <?php if (count($stocks) > 0) { ?>
        <div class="frame-baner frame-baner-start_page" style="height: 270px;">
            <style>
                #owl-demo .item img {
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
                                <?php foreach ($stocks as $stock) {
                                    /* @var $stock Stock */ ?>
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
                $(document).ready(function () {
                    $("#owl-demo").owlCarousel({

                        navigation: false,
                        slideSpeed: 500,
                        paginationSpeed: 500,
                        singleItem: true,
                        autoPlay: 5000,
                        stopOnHover: true

                    });
                });
            </script>
        </div>
    <?php } ?>
    <div id="new_products">
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
                            <?= ListView::widget([
                                'dataProvider' => $itemsDataProvider,
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
    <?php if ($salesCount > 0) { ?>
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
                                #owl-demo1 .item img {
                                    width: initial;
                                    height: 200px;
                                }

                                .frame-photo-title {
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
                                            <?= ListView::widget([
                                                'dataProvider' => $salesDataProvider,
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
                                                'summary' => '',
                                            ]);
                                            ?>
                                        </div>
                                    </div>

                                    <script>
                                        $(document).ready(function () {
                                            $("#owl-demo1").owlCarousel({

                                                navigation: false,
                                                slideSpeed: 500,
                                                paginationSpeed: 500,
                                                singleItem: true,
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
    <?php } ?>
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
                            #owl-demo2 .item img {
                                width: initial;
                                height: 200px;
                            }

                            .frame-photo-title {
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
                                        <?= ListView::widget([
                                            'dataProvider' => $topDataProvider,
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
                                            'summary' => '',
                                        ]);
                                        ?>

                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function () {
                                        $("#owl-demo2").owlCarousel({

                                            navigation: false,
                                            slideSpeed: 500,
                                            paginationSpeed: 500,
                                            singleItem: true,
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