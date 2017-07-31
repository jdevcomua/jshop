<?php

use yii\widgets\ListView;

/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $category \common\models\ItemCat */
/* @var $chars array */
/* @var $selected array */
/* @var $sort string */
/* @var $minCost float */
/* @var $maxCost float */
/* @var $leftCost float */
/* @var $rightCost float */

$this->title = $category->title;
$this->params['breadcrumbs'][] = $this->title;

$notEmpty = $dataProvider->totalCount > 0 || count($selected) > 0 || $leftCost || $rightCost;
?>
<div class="grid--rev">
    <div class="grid__item large--three-quarters collection-grid">

        <header class="collection__info section-header">
            <h1 class="section-header__title"><?= $category->title ?></h1>
            <div class="rte rte--header space-10"></div>
        </header>

        <?php if ($notEmpty) : ?>
            <div class="collection__sort section-header">
                <div class="section-header__right">
                    <!-- /snippets/collection-sorting.liquid -->
                    <div class="form-horizontal">
                        <label for="SortBy">Сортировать</label>
                        <select name="SortBy" id="SortBy">
                            <option value="date"<?= $sort == 'date' ? ' selected' : '' ?>>по дате добавления</option>
                            <option value="asc"<?= $sort == 'asc' ? ' selected' : '' ?>>по возрастанию цены</option>
                            <option value="desc"<?= $sort == 'desc' ? ' selected' : '' ?>>по убыванию цены</option>
                        </select>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => function ($model) {
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

    <?php if ($notEmpty) : ?>
        <?= $this->render('_category-sidebar', [
            'characteristics' => $chars,
            'selected' => $selected,
            'category' => $category,
            'sort' => $sort,
            'maxCost' => $maxCost,
            'minCost' => $minCost,
            'leftCost' => $leftCost,
            'rightCost' => $rightCost,
        ]) ?>
    <?php endif; ?>

</div>
