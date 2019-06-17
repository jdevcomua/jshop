<?php

use common\models\ItemCat;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ItemCat */
/* @var $model common\models\Parse[] */
/* @var $characteristics \yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Категории'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-cat-view">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title); ?></h3>
        </div>
        <div class="box-body">
            <p>
                <?= Html::a(Yii::t('app', 'Создать'), Yii::$app->urlHelper->to(['item-cat/create']), ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to(['item-cat/update', 'id' => $model->id]),
                        ['class' => 'btn btn-primary']); ?>
                <?= Html::a(Yii::t('app', 'Добавить парс урл'), Yii::$app->urlHelper->to(['item-cat/add-parse-url', 'id' => $model->id]),
                    ['class' => 'btn btn-primary']); ?>
                <?= Html::a(Yii::t('app', 'Удалить'), Yii::$app->urlHelper->to(['item-cat/delete', 'id' => $model->id]), [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить эту категорию?'),
                        'method' => 'post',
                    ],
                ]); ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'active:boolean',
                    [
                        'attribute' => 'parent_id',
                        'format' => 'raw',
                        'value' => $model->parent_id
                            ? Html::a($model->parent->title, ['category/view', 'id' => $model->parent_id]) : null,
                    ],
                ],
            ]); ?>
            <?php if(isset($parsers)):?>
                <?php foreach ($parsers as $parser):?>
                    <table class='table table-striped table-bordered detail-view'>
                        <tr id="<?php echo $parser->id ?>">
                            <th>Url</th>
                            <td id="<?php echo $parser->id ?>"><?=$parser->url?>
                                <input class="btn btn-danger" style="float:right;" type="button" id="<?php echo $parser->id ?>" onclick="deleteParser(event, this, parentElement)" value="<?=Yii::t('app','Удалить')?>">
                            </td>
                        </tr>
                    </table>
                <?php endforeach;?>
            <?php endif;?>
            <h3>Характеристики</h3>
            <p><?= Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to(['item-cat/characteristics', 'id' => $model->id]),
                ['class' => 'btn btn-primary']); ?></p>
            <?= GridView::widget([
                'dataProvider' => $characteristics,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'title',
                    'typeTitle'
                ],
            ]); ?>
        </div>
    </div>
</div>
