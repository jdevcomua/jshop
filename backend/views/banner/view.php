<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Баннеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-view">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <p>
                <?php echo Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to(['banner/update', 'id' => $model->id]),
                        ['class' => 'btn btn-primary']) . ' ';
                echo Html::a(Yii::t('app', 'Удалить'), Yii::$app->urlHelper->to(['banner/delete', 'id' => $model->id]), [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот баннер?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'label' => 'enable',
                        'value' => Html::tag('span', $model->enable == 1 ? 'Да' : 'Нет',
                            ['class' => 'label ' . ($model->enable == 1 ? 'label-success' : 'label-danger')]),
                        'format' => 'raw',
                    ],
                    'url:url',
                    'positionTitle',
                    'imageUrl:image',
                ],
            ]) ?>
        </div>
    </div>
</div>
