<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $categories array */

$this->title = Yii::t('app', 'Редактировать товар: ') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>
<div class="item-update">

    <h3><?php echo Html::encode($this->title) ?></h3>

    <?php echo $this->render('_form', [
        'model' => $model, 'categories' => $categories,
    ]) ?>

</div>
