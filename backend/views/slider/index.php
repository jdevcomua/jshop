<?php
use \common\models\Slider;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Slider');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-index">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?= Html::encode($this->title) ?>
                <?= Html::a(Yii::t('app','Create Slider'), ['create'], ['class' => 'btn btn-success']) ?>
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
                        },
                        'header' => HTML::tag('span',null,['class'=>'glyphicon glyphicon-alert','title'=>Yii::t('app','For delete or edit')]),
                    ],
                    'title',
                    'largeTitle',
                    'description',
                    'image',
                    [
                        'attribute' => 'type',
                        'filter' => Slider::getSliderTypes(),
                        'value' => function (Slider $model) {
                            return $model->getSliderType();
                        },
                    ],


                    ['class' => 'yii\grid\ActionColumn',
                        'urlCreator' => function ($action, $model, $key, $index) {
                            return Yii::$app->urlHelper->to(['slider/' . $action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]);
            echo Html::submitButton(Yii::t('app', 'Удалить'), ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'del']);
            echo Html::endForm();
            ?>
        </div>
    </div>
</div>
