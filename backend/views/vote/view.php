<?php

use common\models\Vote;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Vote */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Отзывы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vote-view">

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <p>
                <?= Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to(['vote/update', 'id' => $model->id]),
                    ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Удалить'), Yii::$app->urlHelper->to(['vote/delete', 'id' => $model->id]), [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот отзыв?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'label' => 'Товар',
                        'value' => Html::a(Html::encode($model->item->title), Yii::$app->urlHelper->to(['item/view', 'id' => $model->item->id])),
                        'format' => 'raw',
                    ],
                    [
                        'label' => 'Пользователь',
                        'value' => empty($model->user_id) ? null : Html::a(Html::encode($model->user->name), Yii::$app->urlHelper->to(['user/view', 'id' => $model->user->id])),
                        'format' => 'raw',
                    ],
                    'timestamp',
                    'text:ntext',
                    'rating',
                    [
                        'attribute' => 'checked',
                        'value' => $model->checked == Vote::STATUS_CHECKED ? 'Одобрен' : ($model->checked == Vote::STATUS_NOT_CHECKED ? 'Не проверен' : 'Скрыт')
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
