<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Stock */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-view">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to(['stock/update', 'id' => $model->id]), ['class' => 'btn btn-primary']) . ' ';
        echo Html::a(Yii::t('app', 'Удалить'), Yii::$app->urlHelper->to(['stock/delete', 'id' => $model->id]), [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить эту акцию?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div style="width: 100%;">
        <div style="width: 70%; float:left; padding-right: 50px;">
    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'date_from',
            'date_to',
            'description:ntext',
            'type',
            'value',
        ],
    ]);?>
        </div></div>

    <?php if (isset($model->image)) { ?>
        <div style="height: 280px;">
            <img style="max-width: 250px;max-height: 250px;" src="<?php echo $model->getImageUrl(); ?>">
        </div>
    <?php } ?>
    <?php echo GridView::widget([
        'dataProvider' => $items,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'item.title',
                'value' => function($data){
                    return Html::a(Html::encode($data->item->title), Yii::$app->urlHelper->to(['item/view','id'=>$data->item->id]));
                },
                'format' => 'raw',
            ],
            'item.cost',
            'item.newPrice',

        ],
    ]);

    ?>

</div>
