<?php
use common\models\ItemCat;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/* @var ActiveRecord[] $items */
/* @var ActiveRecord[] $top10Items */

?>



<div class="block block-layered-nav mt-0">
    <div class="block-title"> <?=Yii::t('app','Manufacturers')?> </div>
    <div class="block-content">
        <dl id="narrow-by-list">
            <dd class="odd">
                <ol class="filter-top full <?= isset($top10Items) ? 'hidden' : ''?>">
                    <?php foreach ($items as $key => $item): ?>
                        <li>
                            <input class="manufacturer" type="checkbox" <?php if (!empty(Yii::$app->session->get('manufacturer')) && in_array($key,Yii::$app->session->get('manufacturer'))):?> checked <?php endif;?> onclick="manufacturer(<?=$item->id?>,this)"">
                            <span class="manufacturer-text"><?=$item->name ?> (<?=$item->quantity ?>)</span>
                        </li>
                    <?php endforeach;?>
                </ol>
                <?php if ($top10Items):?>
                    <ol class="filter-top top-10">
                        <?php foreach ($top10Items as $key => $item): ?>
                            <li>
                                <input class="manufacturer" type="checkbox" <?php if (!empty(Yii::$app->session->get('manufacturer')) && in_array($key,Yii::$app->session->get('manufacturer'))):?> checked <?php endif;?> onclick="manufacturer(<?=$item->id?>,this)"">
                                <span class="manufacturer-text"><?=$item->name ?> (<?=$item->quantity ?>)</span>
                            </li>
                        <?php endforeach;?>
                    </ol>
                    <a class="filter-top full <?= isset($top10Items) ? 'hidden' : ''?>" onclick="filterHideShow(this)" href="#"><?= Yii::t('app','Show Top 10')?></a>
                    <a class="filter-top top-10" onclick="filterHideShow(this)" href="#"><?= Yii::t('app','Show all')?></a>
                    <br />
                <?php endif ?>
                <a class="price-range" onclick="removeManufacturer()" href="#"><?= Yii::t('app','Clear Manufacturer')?></a>
            </dd>
        </dl>
    </div>
</div>
