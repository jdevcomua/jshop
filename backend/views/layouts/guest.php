<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AppAsset;

//use Yii;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?php echo Yii::$app->language ?>">
    <head>
        <meta charset="<?php echo Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="skin-blue fixed sidebar-mini">
    <?php $this->beginBody() ?>

    <div class="wrapper guest-wrapper">
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                <?= $content ?>
            </section>
        </div>
        <!-- /.content-wrapper -->

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>