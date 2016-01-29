<?php

use yii\bootstrap\ActiveForm;
use unclead\widgets\TabularInput;
use yii\helpers\Html;
use common\models\Characteristic;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $models Characteristic[]*/

$this->title = Yii::t('app', 'Создать характеристики');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Cats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-cat-create">

    <h3><?php echo Html::encode($this->title) ?></h3>

    <?php $form = \yii\bootstrap\ActiveForm::begin();
    echo TabularInput::widget([
        'models' => $models,
        'attributeOptions' => [
            'enableAjaxValidation'      => false,
            'enableClientValidation'    => true,
            'validateOnChange'          => false,
            'validateOnSubmit'          => true,
            'validateOnBlur'            => false,
        ],
        'columns' => [
            [
                'name'  => 'title',
                'title' => 'Title',
                'value' => function($data){
                    return $data->title;
                }
            ],
        ],
    ]);

    echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']);
    ActiveForm::end();?>
</div>
