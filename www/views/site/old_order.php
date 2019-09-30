<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\models\Orders;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\Orders */
/* @var $user \common\models\User */
/* @var $itemsDataProvider \yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Order #') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Корзина'), 'url' => ['/cart']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-main col-sm-12 wow bounceInUp animated animated" style="visibility: visible;">
                <?php Pjax::begin() ?>
                <?= \yii\widgets\DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'timestamp:datetime',
                        [
                            'label' => Yii::t('app','Order status'),
                            'value' => Orders::getStatusTitles()[$model->order_status],
                        ],
                    ],
                ]) ?>
                <?php Pjax::end()?>
            </section>
        </div>
    </div>
</div>
