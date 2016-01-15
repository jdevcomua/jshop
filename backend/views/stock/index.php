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

    <h3><?php echo Html::encode($this->title) . ' ' .
            Html::a(Yii::t('app', 'Создать акцию'), ['create'], ['class' => 'btn btn-success']) ?></h3>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            //'date_from',
            //'date_to',
            'description:ntext',
            // 'type',
            // 'value',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
