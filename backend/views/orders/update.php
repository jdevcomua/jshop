<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

/* @var $model common\models\Orders */

$this->title = Yii::t('app', 'Редактировать заказ ') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Заказы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Заказ №' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменить');
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
