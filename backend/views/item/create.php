<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $categories array */

$this->title = Yii::t('app', 'Создать товар');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">

    <h3><?php echo Html::encode($this->title) ?></h3>

    <?php echo $this->render('_form', [
        'model' => $model, 'categories' => $categories,
    ]) ?>

</div>
