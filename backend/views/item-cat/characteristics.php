<?php

use unclead\multipleinput\TabularInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use common\models\Characteristic;

/* @var $this yii\web\View */
/* @var $models Characteristic[] */
/* @var $category \common\models\ItemCat */

$this->title = Yii::t('app', 'Характеристики категории: ' . $category->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Категории'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => ['view', 'id' => $category->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-cat-create">

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title); ?></h3>
        </div>
        <div class="box-body">
            <?php $form = \yii\bootstrap\ActiveForm::begin();
            echo TabularInput::widget([
                'models' => $models,
                'attributeOptions' => [
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                    'validateOnChange' => false,
                    'validateOnSubmit' => true,
                    'validateOnBlur' => false,
                ],
                'allowEmptyList' => true,
                'columns' => [
                    [
                        'name' => 'title',
                        'title' => 'Название',
                        'value' => function ($data) {
                            return $data->title;
                        }
                    ],
                    [
                        'name' => 'type',
                        'type'  => 'dropDownList',
                        'title' => 'Вид в фильтрах',
                        'value' => function ($data) {
                            return $data->type;
                        },
                        'items' => Characteristic::getTypesArray(),
                        'headerOptions' => [
                            'style' => 'width: 250px;',
                        ]
                    ],
                    [
                        'name' => 'id',
                        'options' => [
                            'class' => 'hide'
                        ],
                        'value' => function ($data) {
                            return $data->id;
                        }
                    ],
                ],
            ]);

            echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']);
            ActiveForm::end(); ?>
        </div>
    </div>
</div>
