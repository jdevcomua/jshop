<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="frame-inside page-404">
    <div class="container">
        <div class="content" style="padding-bottom: 70px;">
            <img src="/404.png"/>
            <div class="description">
                <div class="title"><?php echo Html::encode($this->title) ?></div>
                <p><?php echo nl2br(Html::encode($message)) ?></p>
                <p>The above error occurred while the Web server was processing your request. </p>
                <p> Please contact us if you think this is a server error. Thank you. </p>
                <div class="btn-form">
                    <a href="/"><span class="text-el">Главная страница</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="h-footer"></div>
