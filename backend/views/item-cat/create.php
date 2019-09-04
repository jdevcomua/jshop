<?php


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ItemCat */
/* @var $seo common\models\Seo */
/* @var $categories array */

$this->title = Yii::t('app', 'Создать категорию');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Категории'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="item-cat-create">
    <?php echo $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'seo' => $seo,
    ]) ?>
</div>
