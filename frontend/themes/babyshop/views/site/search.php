<?php

use common\models\ItemCat;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $text string */
/* @var $count integer */
/* @var $categories ItemCat[] */
/* @var $category_id integer */
/* @var $sort string */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'Результаты поиска «' . $text . '»';
$this->params['breadcrumbs'][] = 'Поиск';
?>
<div class="grid--rev">
    <div class="grid__item large--three-quarters collection-grid">

        <header class="collection__info section-header">
            <h1 class="section-header__title"><?= $this->title ?></h1>
            <div class="rte rte--header space-10"></div>
        </header>

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
        
        <form id="filterForm">
            <?= Html::input('hidden', 'sort', $sort, ['id' => 'sort_input']) ?>
            <?= Html::input('hidden', 'text', $text) ?>
        </form>

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

    <?= $this->render('_search-sidebar', ['categories' => $categories]) ?>

</div>
