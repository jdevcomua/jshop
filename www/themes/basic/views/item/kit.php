<?php
/* @var $item \common\models\Item */
/* @var $kit \common\models\Kit */
?>
<ul class="items items-bask row-kits rowKits">
    <li class="f-s_0">
        <div class="frame-kit main-product">
            <div class="frame-photo-title">
                <span class="photo-block kit-photo-block">
                    <span class="helper"></span>
                    <img
                        src="<?php echo array_shift($item->getImageUrl()); ?>">
                </span>
                <span class="title"><?php echo $item->getTitle() ?></span>
            </div>
            <div class="description">
                <div class="frame-prices f-s_0">
                    <!-- Start. Product price-->
                    <span class="current-prices f-s_0">
                        <span class="price-new">
                            <span>
                                <span class="price priceVariant">
                                    <?= $item->getCost(); ?>
                                </span> грн.
                            </span>
                        </span>
                    </span>
                    <!-- End. Product price-->
                </div>
            </div>
        </div>
    </li>

    <?php foreach ($kit->kitItems as $kitItem) {
        /* @var $kitItem \common\models\KitItem */
        if ($kitItem->item_id != $item->id) { ?>
            <li class="f-s_0">
                <div class="next-kit">+</div>
                <div class="frame-kit">
                    <a href="<?= $kitItem->item->getUrl(); ?>" class="frame-photo-title">
                        <span class="photo-block kit-photo-block">
                            <span class="helper"></span>
                            <img src="<?= array_shift($kitItem->item->getImageUrl()); ?>">
                        </span>
                        <span class="title">
                            <?= $kitItem->item->getTitle(); ?>
                        </span>
                    </a>
                    <div class="description">
                        <div class="frame-prices f-s_0">
                            <!-- Check for discount-->
                            <!-- Start. Product price-->
                            <span class="current-prices f-s_0">
                                <span class="price-new">
                                    <span>
                                        <span class="price priceVariant">
                                            <?= $kitItem->item->getCost(); ?>
                                        </span> грн.
                                    </span>
                                </span>
                            </span>
                            <!-- End. Product price-->
                        </div>
                    </div>
                </div>
            </li>
        <?php }
    } ?>
</ul>
<!-- total -->
<div class="complect-gen-sum">
    <div class="gen-sum-kit">=</div>
    <div class="frame-gen-price-buy-complect">
        <div class="frame-prices f-s_0">
            <span class="price-discount">
                <span>
                    <span class="price">
                        <?php $sum = 0.0;
                        foreach ($kit->kitItems as $kitItem) {
                            /* @var $kitItem \common\models\KitItem */
                            $sum = $sum + $kitItem->item->cost;
                        }
                        echo $sum; ?>
                    </span> грн.
                </span>
            </span>
            <span class="current-prices f-s_0">
                <span class="price-new">
                    <span>
                        <span class="price">
                            <?= $kit->cost; ?>
                        </span> грн.
                    </span>
                </span>
            </span>
        </div>
        <div class="btn-cart-p btn-cart d_n">
            <button type="button" data-id="16" class="btnBuy infoBut btnBuyKit">
                <span class="icon_cleaner icon_cleaner_buy"></span>
                <span class="text-el">В корзине</span>
            </button>
        </div>
        <div class="btn-buy-p btn-buy">
            <button type="button" data-id="16" onclick="addKit(<?php echo $kit->id ?>)"
                    class="btnBuy infoBut btnBuyKit">
                <span class="icon_cleaner icon_cleaner_buy"></span>
                <span class="text-el">Купить</span>
            </button>
        </div>
    </div>
</div>
<!-- /total -->