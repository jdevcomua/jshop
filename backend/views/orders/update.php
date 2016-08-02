<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

/* @var $model common\models\Orders */

$this->title = Yii::t('app', 'Редактировать заказ ') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="orders-update">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <?php echo $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
