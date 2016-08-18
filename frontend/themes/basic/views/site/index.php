<?php

use common\models\Stock;
use frontend\widgets\sliders\flex\FlexSlider;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use common\models\Item;

/* @var $category \common\models\ItemCat */
/* @var $stocks Stock[] */
/* @var $salesCount integer */
/* @var $itemsDataProvider ActiveDataProvider */
/* @var $saleItems Item[] */
/* @var $topItems Item[] */

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
                    </div>
                </div>
            </section>
        </div>

    </div>

</div>
<div class="right-start-page">
    <div class="frame-little-banner">
        <p>
            <a href="http://active.imagecmsdemo.net/dostavka">
                <img src="http://active.imagecmsdemo.net/uploads/shop/banners/banner_small.jpg" alt="">
            </a>
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
                        <div class="items-carousel" style="position: relative; display: block;">
                            <?php $topItemsSlider = [];
                            foreach ($topItems as $topItem) {
                                $topItemsSlider[] = $this->render('item', ['value' => $topItem]);
                            }
                            echo FlexSlider::widget([
                                'items' => $topItemsSlider,
                                'options' => [
                                    'class' => 'content-carousel container',
                                ],
                                'slidesOptions' => [
                                    'class' => 'slides items items-catalog items-v-carousel',
                                ],
                                'pluginOptions' => [
                                    'animation' => 'slide',
                                    'direction' => 'vertical',
                                    'controlNav' => false,
                                    'customDirectionNav' => new \yii\web\JsExpression('$(".group-button-carousel-top button")'),
                                ],
                            ]); ?>
                            <div class="group-button-carousel group-button-carousel-top">
                                <button type="button" style="display: inline-block;" class="flex-prev prev arrow">
                                    <span class="icon_arrow_p"></span>
                                </button>
                                <button type="button" style="display: inline-block;" class="flex-next next arrow">
                                    <span class="icon_arrow_n"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    <?php } ?>
    <div id="popular_products">
        <div class="vertical-carousel">
            <section class="special-proposition">
                <div class="title-proposition-v">
                    <div class="frame-title">
                        <div class="title">хит продаж</div>
                    </div>
                </div>
                <div class="big-container">
                    <div class="items-carousel" style="position: relative; display: block;">
                        <?php $saleItemsSlider = [];
                        foreach ($saleItems as $saleItem) {
                            $saleItemsSlider[] = $this->render('item', ['value' => $saleItem]);
                        }
                        echo FlexSlider::widget([
                            'items' => $saleItemsSlider,
                            'options' => [
                                'class' => 'content-carousel container',
                            ],
                            'slidesOptions' => [
                                'class' => 'slides items items-catalog items-v-carousel',
                            ],
                            'pluginOptions' => [
                                'animation' => 'slide',
                                'direction' => 'vertical',
                                'controlNav' => false,
                                'customDirectionNav' => new \yii\web\JsExpression('$(".group-button-carousel-hit button")'),
                            ],
                        ]); ?>
                        <div class="group-button-carousel group-button-carousel-hit">
                            <button type="button" style="display: inline-block;" class="flex-prev prev arrow">
                                <span class="icon_arrow_p"></span>
                            </button>
                            <button type="button" style="display: inline-block;" class="flex-next next arrow">
                                <span class="icon_arrow_n"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>