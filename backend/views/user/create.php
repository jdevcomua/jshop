<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = Yii::t('app', 'Добавить пользователя');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
