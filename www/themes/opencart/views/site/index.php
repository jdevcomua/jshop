<?php

use common\models\Banner;
use common\models\Item;
use common\models\Stock;
use frontend\widgets\item\ItemView;
use frontend\widgets\sliders\flex\FlexSlider;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

/* @var $category \common\models\ItemCat */
/* @var $stocks Stock[] */
/* @var $salesCount integer */
/* @var $itemsDataProvider ActiveDataProvider */
/* @var $saleItems Item[] */
/* @var $topItems Item[] */
/* @var $rightBanner Banner|null */
/* @var $centerBanners Banner[] */
?>
<?= FlexSlider::widget([
    'items' =>$centerBanners,
])?>
<h3>Избранное</h3>
<div class="row product-layout">
    <?= ListView::widget([
        'dataProvider' => $itemsDataProvider,
        'layout' => '{items}',
        'itemView' => function ($model, $key, $index, $widget) {
            return ItemView::widget(['model' => $model,'count' =>4]);
        }
    ]);
    ?>
</div>