<?php

use yii\widgets\ListView;

/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $category \common\models\ItemCat */
/* @var $chars array */
/* @var $selected array */

$this->title = $category->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grid--rev">
    <div class="grid__item large--three-quarters collection-grid">

        <header class="collection__info section-header">
            <h1 class="section-header__title"><?= $category->title ?></h1>
            <div class="rte rte--header space-10"></div>
        </header>

        <div class="collection__sort section-header">
            <div class="section-header__right">
                <!-- /snippets/collection-sorting.liquid -->
                <div class="form-horizontal">
                    <label for="SortBy">Sort by</label>
                    <select name="SortBy" id="SortBy">
                        <option value="manual">Featured</option>
                        <option value="best-selling">Best Selling</option>
                        <option value="title-ascending">Alphabetically, A-Z</option>
                        <option value="title-descending">Alphabetically, Z-A</option>
                        <option value="price-ascending">Price, low to high</option>
                        <option value="price-descending">Price, high to low</option>
                        <option value="created-descending">Date, new to old</option>
                        <option value="created-ascending">Date, old to new</option>
                    </select>
                </div>
            </div>
        </div>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_item', ['model' => $model]);
            },
            'options' => [
                'class' => 'grid-uniform',
            ],
            'itemOptions' => [
                'class' => 'grid__item  large--one-third medium--one-third ',
            ],
            'layout' => "{items}\n{pager}",
        ]); ?>

    </div>

    <?= $this->render('_category-sidebar', ['characteristics' => $chars, 'selected' => $selected, 'category' => $category]) ?>

</div>
