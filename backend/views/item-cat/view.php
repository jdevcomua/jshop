<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCat */
/* @var $characteristics \yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Cats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-cat-view">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title); ?></h3>
        </div>
        <div class="box-body">
            <p>
                <?php echo Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to(['item-cat/update', 'id' => $model->id]),
                        ['class' => 'btn btn-primary']) . ' ';
                echo Html::a(Yii::t('app', 'Удалить'), Yii::$app->urlHelper->to(['item-cat/delete', 'id' => $model->id]), [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить эту категорию?'),
                        'method' => 'post',
                    ],
                ]); ?>
            </p>

            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                ],
            ]); ?>

            <h3>Характеристики</h3>
            <?php echo Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to(['item-cat/characteristics', 'id' => $model->id]), ['class' => 'btn btn-primary']);
            echo GridView::widget([
                'dataProvider' => $characteristics,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'title'
                ],
            ]); ?>
        </div>
    </div>
</div>
