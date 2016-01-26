<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ItemCat */

$this->title = Yii::t('app', 'Создать категорию');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Cats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-cat-create">

    <h3><?php echo Html::encode($this->title) ?></h3>

    <?php echo $this->render('_form', [
        'model' => $model, 'categories' => $categories
    ]) ?>

</div>
