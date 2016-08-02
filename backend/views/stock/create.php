<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Stock */
/* @var $arrayItems array */

$this->title = Yii::t('app', 'Создать акцию');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Акции'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-create">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">
            <?php echo $this->render('_form', [
                'model' => $model, 'arrayItems' => $arrayItems,
            ]) ?>
        </div>
    </div>
</div>
