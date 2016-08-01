<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Kit */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kit-view">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to(['kit/update', 'id' => $model->id]),
                ['class' => 'btn btn-primary']) . ' ';
        echo Html::a(Yii::t('app', 'Удалить'), Yii::$app->urlHelper->to(['kit/delete', 'id' => $model->id]), [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот комплект?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'cost',
        ],
    ]);

    echo GridView::widget([
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
        ],
    ]);?>

</div>
