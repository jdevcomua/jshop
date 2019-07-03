<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SearchSeo */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-index">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::encode($this->title) ?>
                <?= Html::a('Создать seo', ['create'], ['class' => 'btn btn-success']) ?>
            </h3>
        </div>
        <div class="box-body">
            <?php echo Html::beginForm(['del'], 'post');?>

            <?= GridView::widget([
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
                    'description',
                    'keywords',
                    'url:url',
                    'h1',
                    'new_url',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            echo Html::submitButton(Yii::t('app', 'Удалить'), ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'del']);
            echo Html::endForm();
            ?>
        </div>
    </div>
</div>
