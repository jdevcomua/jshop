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
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <p>
                <?php
                    echo Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to(['item/update', 'id' => $model->id]),
                            ['class' => 'btn btn-primary']) . ' ';
                    echo Html::a(Yii::t('app', 'Удалить'), Yii::$app->urlHelper->to(['item/delete', 'id' => $model->id]), [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот предмет?'),
                            'method' => 'post',
                        ],
                    ]) . ' ';
                    echo Html::a(Yii::t('app', 'Создать'), Yii::$app->urlHelper->to(['item/create']),
                        ['class' => 'btn btn-success']) . ' ';
                ?>
            </p>

            <div style="width: 100%;">
                <div style="width: 750px; float:left; padding-right: 25px;">
                    <?php echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'categoryTitle',
                            'title',
                            'barcode',
                            'code',
                            'quantity',
                            'cost',
                            [
                                'attribute' => 'metric',
                                'value' => $model->getMetricTitle(),
                            ],
                            'link:url',
                            'self_cost',
                            [
                                'attribute' => 'description',
                                'format' => 'html'
                            ],
                            'count_of_views',
                        ],
                    ]);
                    echo '<p>' . Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to([
                            'item/update-characteristics', 'id' => $model->id]), ['class' => 'btn btn-primary']) . '</p>';
                    echo GridView::widget([
                        'dataProvider' => $characteristics,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'characteristicTitle',
                            'value',
                        ],
                    ]); ?>
                </div>
            </div>
            <?php foreach ($model->images as $image) { ?>
                <div align="center"
                     style="vertical-align:middle; height: 180px; width: 180px; float:left; padding: 5px 5px 5px 5px;margin: 5px 5px 5px 5px;border:1px dotted #cdc9c9;">
                    <button type="button" class="icon_times deleteFromCompare"
                            style="background: url('http://active.imagecmsdemo.net/templates/active/css/color_scheme_1/images/sprite.png') no-repeat;
                background-position: -440px 0;height: 14px;border: 0;width:14px;position: absolute;"
                            onclick="deleteImage(<?php echo $image->id; ?>, $(this))"></button>
                    <img style="vertical-align:middle;max-width: 170px; max-height: 170px;"
                         src="<?php echo $image->getImageUrl(); ?>"/>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
