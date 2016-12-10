<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
/* @var $code int */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="box-body">

            <div class="alert alert-danger">
                <?php echo nl2br(Html::encode($message)) ?>
            </div>

            <p>
                The above error occurred while the Web server was processing your request.
            </p>
            <p>
                Please contact us if you think this is a server error. Thank you.
            </p>

            <?php if ($code == 403) : ?>
                <a class="btn btn-primary" href="<?= Yii::$app->urlHelper->to(['site/logout']) ?>">Logout</a>
            <?php endif; ?>

        </div>
    </div>
</div>
