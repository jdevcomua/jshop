<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\Orders */
/* @var $sum double */
/* @var $user \common\models\User */
/* @var $models \common\components\CartElement[] */

$this->title = 'Оформление заказа';
$this->params['breadcrumbs'][] = ['label' => 'Корзина', 'url' => ['/cart']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3><?= $this->title ?></h3>
<div class="row">
    <div class="col-md-6">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(); ?>

        <?= $form->field($model, 'mail')->textInput(); ?>

        <?= $form->field($model, 'phone')->textInput(); ?>

        <?= $form->field($model, 'address')->textInput(); ?>

        <?= $form->field($model, 'comment')->textarea(); ?>

        <p class="text-right">
            <?= Html::submitButton('Подтвердить заказ', ['class' => 'btn']) ?>
        </p>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="col-md-6">
        <div class="table-wrap">
            <table class="cart-table order-table full table--responsive">
                <thead class="cart__row cart__header-labels">
                <tr>
                    <th colspan="2" class="text-center">Товар</th>
                    <th class="text-center">Цена</th>
                    <th class="text-center">Кол-во</th>
                    <th class="text-center">Сумма</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($models as $cartElement) : ?>
                    <tr class="cart__row table__section">
                        <td data-label="Товар">
                            <a href="<?= $cartElement->model->getUrl() ?>" class="cart__image">
                                <img src="<?= $cartElement->model->getOneImageUrl() ?>" alt="<?= $cartElement->model->getTitle() ?>">
                            </a>
                        </td>
                        <td>
                            <a href="<?= $cartElement->model->getUrl() ?>" class="h6">
                                <?= $cartElement->model->getTitle() ?>
                            </a>
                        </td>
                        <td class="text-center"><?= $cartElement->model->cost ?> грн.</td>
                        <td class="text-center"><?= $cartElement->count ?></td>
                        <td class="text-center"><?= $cartElement->model->cost*$cartElement->count ?> грн.</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5" class="text-right">
                        <strong>Сумма:   <?= Yii::$app->cart->getSum() ?> грн.</strong>
                    </td>
                </tr>
                </tfoot>
            </table>
            <p class="text-right">
                <?= Html::a('Изменить заказ', ['/cart'], ['class' => 'btn']) ?>
            </p>
        </div>
    </div>
</div>
