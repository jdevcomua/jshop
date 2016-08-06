<?php

use common\models\Stock;
use frontend\widgets\item\ItemView;
use frontend\widgets\sliders\flex\FlexSlider;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var \common\models\WishList[] wishLists */
/* @var Stock[] $stocks*/
/* @var yii\data\ActiveDataProvider $dataProvider*/
?>
<?= FlexSlider::widget([
    'items' =>[
        Html::img('/img/velosiped1.jpg'),
        Html::img('/img/velosiped2.jpg'),
    ],
])?>
<h3>Featured</h3>
<div class="row product-layout">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => function ($model, $key, $index, $widget) {
            return ItemView::widget([
                'model' => $model,
            ]);
        },
        'layout'   => '{items}',
    ]);
    ?>
</div>