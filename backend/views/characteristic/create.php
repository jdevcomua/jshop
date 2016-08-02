<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Characteristic */
/* @var $categories array */

$this->title = Yii::t('app', 'Создать характеристику');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Characteristics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-create">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <?php echo $this->render('_form', [
                'model' => $model, 'categories' => $categories
            ]) ?>
        </div>
    </div>
</div>
