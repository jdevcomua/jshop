<?php
use common\components\CartElement;

/* @var $this \yii\web\View */
/* @var $models CartElement[] */
/* @var $sum double */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 class="page_name"><?= $this->title ?></h3>
<?= $this->render('cartItems', [
    'models' => $models, 'sum' => $sum
]) ?>
