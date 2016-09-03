<?php

use common\models\Banner;
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
/* @var $rightBanner Banner|null */
/* @var $centerBanners Banner[] */

$this->title = 'Интернет-магазин';
?>

<div class="left-start-page">
    <?php if (count($centerBanners) > 0) { ?>
            <?= FlexSlider::widget([
                'items' => $centerBanners,
            'options' => [
                'class' => 'flexslider flex-slider-banners',
            ],
            'pluginOptions' => [
                'animation' => 'slide',
                'controlNav' => false,
            ],
            ])?>
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
    <?php if (isset($rightBanner)) { ?>
        <div class="frame-little-banner">
            <p>
                <a href="<?= $rightBanner->url ?>">
                    <img src="<?= $rightBanner->getImageUrl() ?>" alt="">
                </a>
            </p>
        </div>
    <?php } ?>
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
    <?php if (count($saleItems) > 0) { ?>
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
    <?php } ?>
</div>