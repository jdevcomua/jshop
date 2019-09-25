<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Where is my order');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-container col1-layout wow bounceInUp animated animated" style="visibility: visible;">

    <div class="main">
        <div class="account-login container">
            <!--page-title-->
            <fieldset class="col2-set">
                <div class="col-1 new-users">
                    <strong><?= Yii::t('app','Где ваш заказ')?></strong>
                    <div class="content">
                        <p><?= Yii::t('app','Хотите найти ваш заказ и посмотреть его статус?')?></p>
                    </div>
                </div>
                <div class="col-2 registered-users">
                    <?php $form = ActiveForm::begin(['id' => 'cart-old-order','method' => 'post']); ?>
                    <div class="content">
                        <ul class="form-list">
                            <li>
                                <label for="order_id"><?= Yii::t('app','Номер заказа')?><em class="required">*</em></label>
                                <div class="input-box">
                                    <input type="text" name="order_id" value=""
                                           id="order_id" required class="input-text required-entry validate-email" title="<?=Yii::t('app','Номер заказа')?>">
                                </div>
                            </li>
                        </ul>

                        <p class="required">* <?= Yii::t('app','Required Fields')?></p>
                        <div class="buttons-set">

                            <?= Html::submitButton(Yii::t('app','Найти'), ['class' => 'button login']) ?>

                        </div> <!--buttons-set-->
                    </div> <!--content-->
                    <?php ActiveForm::end(); ?>
                </div> <!--col-2 registered-users-->
            </fieldset> <!--col2-set-->


        </div> <!--account-login-->

    </div><!--main-container-->

</div> <!--col1-layout-->
