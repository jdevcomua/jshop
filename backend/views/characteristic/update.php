<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Characteristic */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Characteristics'), 'url' => ['index']];
if($count == 'one') {
    $this->title = Yii::t('app', 'Редактировать характеристику: ', [
            'modelClass' => 'Characteristic',
        ]) . ' ' . $model->title;
    $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
}
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>
<div class="characteristic-update">

    <h3><?php
        if($count == 'one'){
            echo Html::encode($this->title);
        }
        ?></h3>

    <?php
    if($count == 'one'){
        echo $this->render('_form', [
            'model' => $model,
        ]);
    } else {
        echo $this->render('groupForm', [
            'models' => $models,
        ]);
    }
     ?>

</div>
