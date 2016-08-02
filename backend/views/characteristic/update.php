<?php

use common\models\Characteristic;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Characteristic */
/* @var $models Characteristic[] */
/* @var $categories array */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Characteristics'), 'url' => ['index']];
if ($count == 'one') {
    $this->title = Yii::t('app', 'Редактировать характеристику: ') . ' ' . $model->title;
    $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
}
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>
<div class="characteristic-update">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?php if ($count == 'one') {
                    echo Html::encode($this->title);
                } else {
                    echo 'Редактировать характеристики';
                } ?></h3>
        </div>
        <div class="box-body">
            <?php if ($count == 'one') {
                echo $this->render('_form', [
                    'model' => $model, 'categories' => $categories,
                ]);
            } else {
                echo $this->render('groupForm', [
                    'models' => $models,
                ]);
            } ?>
        </div>
    </div>
</div>
