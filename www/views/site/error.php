<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = Yii::t('app',$name);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-center">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <p><?php echo nl2br(Html::encode($message)) ?></p>

</div>
