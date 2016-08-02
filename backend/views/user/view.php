<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <p>
                <?php echo Html::a(Yii::t('app', 'Редактировать'), Yii::$app->urlHelper->to(['user/update', 'id' => $model->id]),
                        ['class' => 'btn btn-primary']) . ' ';
                echo Html::a(Yii::t('app', 'Удалить'), Yii::$app->urlHelper->to(['user/delete', 'id' => $model->id]), [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этого пользователя?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'mail',
                    'city',
                ],
            ]) ?>
        </div>
    </div>
</div>
