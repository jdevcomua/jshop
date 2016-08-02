<?php

use common\models\ItemCat;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model ItemCat */
/* @var $models ItemCat */
/* @var $categories array */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Cats'), 'url' => ['index']];
if ($count == 'one') {
    $this->title = Yii::t('app', 'Редактировать категорию: ') . ' ' . $model->title;
    $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
}
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>
<div class="item-cat-update">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if ($count == 'one') {
                    echo Html::encode($this->title);
                } else {
                    echo 'Редактировать категории';
                } ?></h3>
        </div>
        <div class="box-body">
            <?php if ($count == 'one') {
                echo $this->render('_form', [
                    'model' => $model, 'categories' => $categories,
                ]);
            } else {
                echo $this->render('groupForm', [
                    'models' => $models,
                ]);
            } ?>
        </div>
    </div>
</div>
