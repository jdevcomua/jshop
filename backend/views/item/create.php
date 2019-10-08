<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $seo common\models\Seo */
/* @var $categories array */

$this->title = Yii::t('app', 'Создать товар');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Товары'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">
    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'seo' => $seo,
    ]) ?>
</div>
