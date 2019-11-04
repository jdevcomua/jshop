<?php

use common\models\ItemCat;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $deleted string */

$this->title = Yii::t('app', 'Категории');
$this->params['breadcrumbs'][] = $this->title;
$map = ArrayHelper::getColumn($dataProvider->models,'id');
?>
<div class="item-cat-index">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::encode($this->title) ?>
                <?= Html::a(Yii::t('app', 'Создать категорию'),['item-cat/create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-success']) ?>
            </h3>
        </div>
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'id',
                        'filter' => false,
                    ],
                    [
                        'attribute' => 'title',
                        'filter' => false,
                        'value' => function(ItemCat $model){
                            $s = '';
                            for ($i = 1; $i < $model->treeDepth; $i++){
                                $s .= '----';
                            }
                            return $s . ' ' . $model->title;
                        }
                    ],
                    [
                        'attribute' => 'active',
                    ],
                    [
                         'class' => 'yii\grid\ActionColumn',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
