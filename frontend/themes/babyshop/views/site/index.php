<?php
use yii\widgets\ListView;

/* @var $itemsDataProvider \yii\data\ActiveDataProvider */
?>
<div class="wrapper" style="margin: 0 -30px;">
    <!-- /templates/snippets/section-custom-top.liquid -->
    <div class="section-custom-top radius-10">
        <div class="grid">
            <div class="grid__item section-product-new" style="padding-top: 10px;">
                <h2 class="title">Популярные товары</h2>
            </div>
        </div>
    </div>
</div>
<div class="grid">
    <div class="grid__item">
        <section>
            <div class="inner space-30 section-product-new">
                <div class="arrivals ">
                    <?= ListView::widget([
                        'dataProvider' => $itemsDataProvider,
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('_item', ['model' => $model]);
                        },
                        'options' => [
                            'class' => 'grid grid-uniform',
                        ],
                        'itemOptions' => [
                            'class' => 'grid__item large--one-quarter medium--one-quarter ',
                        ],
                        'layout' => "{items}\n{pager}",
                    ]); ?>
                </div>
            </div>
        </section>
    </div>
</div>