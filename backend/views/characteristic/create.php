<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Characteristic */

$this->title = Yii::t('app', 'Создать характеристику');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Characteristics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-create">

    <h3><?php echo Html::encode($this->title) ?></h3>

    <?php echo $this->render('_form', [
        'model' => $model, 'categories' => $categories
    ]) ?>

</div>
