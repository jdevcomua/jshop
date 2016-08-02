<?php

use yii\helpers\Html;

/* @var $arrayItems array */
/* @var $this yii\web\View */
/* @var $model common\models\Kit */

$this->title = Yii::t('app', 'Создать комплект');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kit-create">
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
