<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\Orders */
/* @var $sum double */
/* @var $user \common\models\User */
/* @var $models \common\components\CartElement[] */

$this->title = 'Checkout';
$this->params['breadcrumbs'][] = ['label' => 'Basket', 'url' => ['/cart']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-main col-sm-9 wow bounceInUp animated animated" style="visibility: visible;">
                <?php $form = ActiveForm::begin(['options' => ['id'=> 'order-form','class' => 'comment-form']]); ?>
                <ol class="one-page-checkout" id="checkoutSteps">
                    <li id="opc-address" class="section allow active">
                        <div class="step-title"> <span class="number">1</span>
                            <h3 class="one_page_heading"> <?=Yii::t('app','Address Information')?></h3>
                        </div>
                        <div id="checkout-step-address" class="step a-item" style="">
                            <fieldset class="group-select">
                                <ul class="">
                                    <li id="billing-new-address-form">
                                        <fieldset>
                                            <ul>
                                                <li class="fields">
                                                    <div class="customer-name">
                                                        <div class="input-box name-firstname">
                                                            <label for="orders-name"><?=Yii::t('app','Name and Surname')?><span class="required">*</span></label>
                                                            <div class="input-box1">
                                                                <input type="text" id="orders-name" name="Orders[name]" style="margin-bottom: 2px;margin-left: 2px;" value="<?=$model->name?>" title="First Name" maxlength="255" class="input-text required-entry" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="fields">
                                                    <div class="customer-phone">
                                                        <div class="input-box phone">
                                                            <label for="orders-phone"><?=Yii::t('app','Phone number')?><span class="required">*</span></label>
                                                            <div class="input-box1">
                                                                <input type="text" id="orders-phone" name="Orders[phone]" style="margin-bottom: 2px;margin-left: 2px;" value="<?= $model->phone ?>" title="Phone number" maxlength="255" class="input-text required-entry" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="fields">
                                                    <div class="input-box">
                                                        <label for="orders-address"><?=Yii::t('app','Address')?> - <?= $model->address?><span class="required">*</span></label>
                                                        <input type="text" id="orders-address" name="Orders[address]" style="margin-bottom: 2px;margin-left: 2px;" value="<?= $model->address ?>" title="Address" class="input-text required-entry" required>
                                                    </div>
                                                </li>
                                                <li class="fields">
                                                    <div class="input-box">
                                                        <label for="orders-mail"><?=Yii::t('app','Mail')?></label>
                                                        <input type="email" id="orders-mail" name="Orders[mail]" style="margin-bottom: 2px;margin-left: 2px;" value="<?= $model->mail ?>" title="Email" class="input-text">
                                                    </div>
                                                </li>
                                                <li class="fields">
                                                    <div class="input-box">
                                                        <label for="orders-address"><?=Yii::t('app','Comment')?></label>
                                                        <textarea style="border-radius: 39px" id="orders-comment" style="margin-bottom: 2px;margin-left: 2px;" name="Orders[comment]"  title="Comment" class="input-text"></textarea>
                                                    </div>
                                                </li>
                                            </ul>
                                        </fieldset>
                                    </li>
                                </ul>
                                <div class="buttons-set" id="billing-buttons-container">
                                    <p class="required"><?=Yii::t('app','Required Fields')?></p>
                                    <button id="submit_step_one" type="button" title="Continue" class="button continue"><span><?=Yii::t('app','Continue')?></span></button>
<!--                                        <span class="please-wait" id="billing-please-wait" style="display:none;"> <img src="images/opc-ajax-loader.gif" alt="Loading next step..." title="Loading next step..." class="v-middle"> Loading next step... </span> -->
                                </div>
                            </fieldset>
                        </div>
                    </li>
                    <li id="opc-review" class="section">
                        <div class="step-title"> <span class="number">2</span>
                            <h3 class="one_page_heading"> <?=Yii::t('app','Order Review')?></h3>
                        </div>
                        <div id="checkout-step-review" class="step a-item" style="display: none;">
                            <div class="order-review" id="checkout-review-load">
                                <?php if(!Yii::$app->cart->isEmpty()) { ?>
                                    <p class="block-subtitle"><?=Yii::t('app','Recently added item(s)')?></p>
                                    <ul id="cart-sidebar1" class="mini-products-list">
                                        <?php foreach ($models as $key => $cartElement) {?>
                                            <li class="item <?=($key == count($models)-1) ? 'last1' : ''?>">
                                                <div class="item-inner"><a data-pjax=0 class="product-image" title="<?= $cartElement->model->title?>"
                                                                           href="<?= $cartElement->model->getUrl() ?>"><img alt="<?= $cartElement->model->title?>"
                                                                                                                            src="<?= ($cartElement->model->images) ? (is_array($urls = $cartElement->model->getOneImageUrl()) ? $urls[0] : $urls) : '/images/product_no_image.jpg' ?>"></a>
                                                    <div class="product-details">
                                                        <!--access-->
                                                        <strong><?= $cartElement->count ?></strong> x <span class="price"><?= number_format((float) $cartElement->model->getNewPrice(), 2, '.', '') ?></span>
                                                        <p class="product-name"><a type="_blank" data-pjax=0 href="<?= $cartElement->model->getUrl() ?>"><?= $cartElement->model->title ?></a></p>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php }?>
                                    </ul>
                                <?php } ?>
                                <br>
                                <div class="buttons-set" id="billing-buttons-container">
                                    <input class="hidden" name="send" value="true">
                                    <button id="return_cart" type="button" title="Return Cart" class="button return-cart" onClick="location.replace('<?= \yii\helpers\Url::toRoute('cart/index') ?>')"><span>Edit Cart</span></button>
                                    <button id="submit" type="submit" title="Submit" class="button send"><span><?=Yii::t('app','Submit')?></span></button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ol>
                <?php ActiveForm::end(); ?>
            </section>

            <aside class="col-right sidebar col-sm-3 wow bounceInUp animated animated" style="visibility: visible;">
                <div id="checkout-progress-wrapper">
                    <div class="block block-progress">
                        <div class="block-title"> <?=Yii::t('app','Your Checkout')?> </div>
                        <div class="block-content">
                            <dl>
                                <div id="billing-progress-opcheckout">
                                    <dt id="address_view"> <?=Yii::t('app','Address')?> : <?= $model->address ?> </dt>
                                </div>
                                <div id="shipping_method-progress-opcheckout">
                                    <dt> <?=Yii::t('app','Shopping Method')?> : <?= (Yii::$app->user->isGuest) ? 'Not registered' : 'Registered' ?> </dt>
                                </div>
<!--                                <div id="payment-progress-opcheckout">-->
<!--                                    <dt> Payment Method</dt>-->
<!--                                </div>-->
                            </dl>
                        </div>
                    </div>
                </div>
            </aside>
            <!--col-right sidebar-->
        </div>
        <!--row-->
    </div>
    <!--main-container-inner-->
</div>
