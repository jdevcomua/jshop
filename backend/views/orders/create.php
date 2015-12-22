<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Orders */

$this->title = Yii::t('app', 'Создать заказ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-create">

    <h3><?php echo Html::encode($this->title) ?></h3>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
