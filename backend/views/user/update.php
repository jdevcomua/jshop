<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = Yii::t('app', 'Редактировать пользователя: ', [
    'modelClass' => 'Users',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактироваить');
?>
<div class="users-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
