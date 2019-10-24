<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\Letter */

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = Yii::t('app', 'Contact Us');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-container col1-layout wow bounceInUp animated animated" style="visibility: visible;">

    <div class="main">
        <div class="account-login container">
            <br>
            <?= \common\widgets\Alert::widget(['options' => ['class'=>'visible']]) ?>

            <!--page-title-->
            <fieldset class="col2-set">
                <div class="col-1 new-users">
                    <strong><?= Yii::t('app','Напиши нам')?></strong>
                    <div class="content">
                        <p><?= Yii::t('app','Отправте нам письмо, мы обязательно на него ответим.')?></p>
                    </div>
                </div>
                <div class="col-2 registered-users">
                    <?php $form = ActiveForm::begin(['id' => 'cart-old-order','method' => 'post']); ?>
                    <div class="content">
                        <ul class="form-list">
                            <li>


                                <?= $form->field($model, 'letter')->textarea(['maxlength' => true,'rows'=>6, 'class'=>'form-control'])->label($model->getAttributeLabel('letter').'<span class="required">*</span>'); ?>
                                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class'=>'input-box input-text'])->label($model->getAttributeLabel('email').'<span class="required">*</span>'); ?>
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class'=>'input-box input-text'])->label($model->getAttributeLabel('name').'<span class="required">*</span>'); ?>
                                <?= $form->field($model, 'phone')->widget(MaskedInput::className(), ['class' => 'input-text required-entry',
                                    'mask' => '+38 (099) 999-99-99',
                                    'options' => [
                                        'class' => 'input-box input-text',

                                        'placeholder' => Yii::t('app', 'Phone number')
                                    ],
                                    'clientOptions' => [
                                        'clearIncomplete' => true
                                    ]
                                ])->label(Yii::t('app','Phone number').'<span class="required">*</span>')?>
                                <?= $form->field($model, 'order_id')->textInput(['maxlength' => true, 'class'=>'input-box input-text']); ?>
                            </li>
                        </ul>

                        <p class="required">* <?= Yii::t('app','Required Fields')?></p>
                        <div class="buttons-set">

                            <?= Html::submitButton(Yii::t('app','Submit'), ['class' => 'button login']) ?>

                        </div> <!--buttons-set-->
                    </div> <!--content-->
                    <?php ActiveForm::end(); ?>
                </div> <!--col-2 registered-users-->
            </fieldset> <!--col2-set-->


        </div> <!--account-login-->

    </div><!--main-container-->

</div> <!--col1-layout-->
