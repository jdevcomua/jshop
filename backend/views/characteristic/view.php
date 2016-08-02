<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Characteristic */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Характеристики'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-view">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <p>
                <?php echo Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to(['characteristic/update',
                    'id' => $model->id]), ['class' => 'btn btn-primary']) . ' ';
                echo Html::a(Yii::t('app', 'Удалить'), Yii::$app->urlHelper->to(['characteristic/delete', 'id' => $model->id]), [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить эту характеристику?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'categoryTitle',
                    'title',
                ],
            ]) ?>
        </div>
    </div>
</div>
