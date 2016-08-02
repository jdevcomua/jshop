<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Акции');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-index">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo Html::encode($this->title) . ' ' .
                    Html::a(Yii::t('app', 'Создать акцию'), ['create'], ['class' => 'btn btn-success']) ?></h3>
        </div>
        <div class="box-body">
            <?php echo Html::beginForm(['del'], 'post');

            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'name' => 'id',
                        // you may configure additional properties here
                        'checkboxOptions' => function ($model, $key, $index, $column) {
                            return ['value' => $model->id];
                        }
                    ],
                    'id',
                    'title',
                    //'date_from',
                    //'date_to',
                    'description:ntext',
                    // 'type',
                    // 'value',

                    ['class' => 'yii\grid\ActionColumn',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            return Yii::$app->urlHelper->to(['stock/' . $action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]);

            echo Html::submitButton('Удалить', ['class' => 'btn btn-danger',]);
            echo Html::endForm(); ?>
        </div>
    </div>
</div>
