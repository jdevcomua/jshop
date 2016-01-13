<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $characteristics yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Товары'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="item-view">

    <h3><?php echo Html::encode($this->title) ?></h3>

    <p>

        <?php echo Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        echo Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот предмет?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div style="width: 100%;">
        <div style="width: 650px; float:left;">
            <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'categoryTitle',
            'title',
            'cost',
            'count_of_views',
        ],
    ]);
            echo Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to(['item/updatecharacteristics', 'id' => $model->id]), ['class' => 'btn btn-primary']);
            echo GridView::widget([
                'dataProvider' => $characteristics,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'characteristicTitle',
                    'value',
                ],
            ]); ?>
        </div></div>
    <?php if($model->image != ""){
        echo "<div style=\"width: 300px; float:left; padding-left: 50px;\">";
        echo "<img width=\"300px\" src=\"" . $model->getImageUrl() . "\" /></div>";
    }?>


</div>
