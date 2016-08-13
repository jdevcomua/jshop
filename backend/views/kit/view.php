<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Kit */
/* @var $items \yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kit-view">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
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
            ]); ?>

            <h4>Товары, участвующие в акции:</h4>
            <?php echo GridView::widget([
                'dataProvider' => $items,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'item.title',
                        'value' => function ($data) {
                            $a = Html::a(Html::encode($data->item->title), Yii::$app->urlHelper->to(['item/view', 'id' => $data->item->id]));
                            if ($data->is_main_item) {
                                $a = $a . ' ' . Html::tag('span', 'main', ['class' => 'label label-danger']);
                            }
                            return $a;
                        },
                        'format' => 'raw',
                    ],
                    'item.cost',
                ],
            ]); ?>
        </div>
    </div>
</div>
