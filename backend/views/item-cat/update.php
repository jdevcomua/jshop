<?php

use common\models\ItemCat;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model ItemCat */
/* @var $seo common\models\Seo */
/* @var $categories array */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Категории'), 'url' => ['index']];
$this->title = Yii::t('app', 'Редактировать категорию: ') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>

<div class="item-cat-update">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::encode($this->title);?>
            </h3>
        </div>
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'categories' => $categories,
                'seo'=>$seo,
            ]); ?>
        </div>
    </div>
</div>
