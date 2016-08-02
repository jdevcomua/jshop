<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Kit */
/* @var $arrayItems array */
/* @var $selected array */

$this->title = Yii::t('app', 'Редактировать комплект: ') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Комплекты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>
<div class="kit-update">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <?php echo $this->render('_form', [
                'model' => $model, 'arrayItems' => $arrayItems, 'selected' => $selected
            ]) ?>
        </div>
    </div>
</div>
