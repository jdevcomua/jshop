<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\Orders */
/* @var $sum double */
/* @var $user \common\models\User */
/* @var $models \common\components\CartElement[] */

$this->title = Yii::t('app','Checkout');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Basket'), 'url' => ['/cart']];
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
                                        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class'=>'input-text required-entry', 'required'=> true])->label(Yii::t('app','Name and Surname').'<span class="required">*</span>'); ?>
                                        <?= $form->field($model, 'phone')->widget(MaskedInput::className(), ['class' => 'input-text required-entry',
                                            'mask' => '+38 (099) 999-99-99',
                                            'options' => [
                                                'class' => 'input-box input-text',

                                                'placeholder' => Yii::t('app', 'Phone number')
                                            ],
                                            'clientOptions' => [
                                                'clearIncomplete' => true
                                            ]
                                        ])->label(Yii::t('app','Phone number').'<span class="required">*</span>');?>

                                        <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'class'=>'input-text required-entry','required'=> true])->label(Yii::t('app','Address').'<span class="required">*</span>'); ?>
                                        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class'=>'input-text'])->label(Yii::t('app','Mail'));?>
                                        <?= $form->field($model, 'comment')->textarea(['maxlength' => true, 'class'=>'input-text'])->label(Yii::t('app','Comment'));?>
                                    </li>
                                </ul>
                                <div class="buttons-set" id="billing-buttons-container">
                                    <p class="required"><?=Yii::t('app','Required Fields')?> *</p>
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
                                                                                                                            src="<?= ($cartElement->model->images) ? (is_array($urls = $cartElement->model->getOneImageUrl()) ? $urls[0] : $urls) : Yii::$app->params['defaultKitImage'] ?>"></a>
                                                    <div class="product-details">
                                                        <!--access-->
                                                        <strong><?= $cartElement->count ?></strong> <?=  $cartElement->model->getMetricTitle()?> X <span class="price"><?= number_format((float) $cartElement->model->getNewPrice(), 2, '.', '') ?></span>
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
                                    <button id="return_cart" type="button" title="Return Cart" class="button return-cart" onClick="location.replace('<?= \yii\helpers\Url::toRoute('cart/index') ?>')"><span><?=Yii::t('app','Edit Cart')?></span></button>
                                    <button id="submit" type="submit" title="Submit" class="button send button-order" onClick="orderCheck(<?php if($sum==0){echo 0;}else{echo 1;}?>,event)"><span><?=Yii::t('app','Submit')?></span></button>
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
                                    <dt id="address_view"> <?=Yii::t('app','Addresses')?> : <?= $model->address ?> </dt>
                                </div>
                                <div id="shipping_method-progress-opcheckout">
                                    <dt> <?=Yii::t('app','Shopping Method')?> : <?= (Yii::$app->user->isGuest) ? Yii::t('app','Not registered') : Yii::t('app','Registered') ?> </dt>
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
