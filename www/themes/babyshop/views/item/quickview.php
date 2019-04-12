<?php
/* @var $modalModel \common\models\Item */
use yii\helpers\Html;
use yii\helpers\Url;

$modalModel = \common\models\Item::findOne(3);
/* @var $inCart boolean */

\yii\widgets\Pjax::begin(['id'=>'modal_pjax']);
